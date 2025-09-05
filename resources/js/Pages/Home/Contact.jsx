import React, { useContext, useEffect } from 'react';
import HomeLayout from '../Layout/HomeLayout';
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import { useForm } from '@inertiajs/react';
import FormErrorInput from '../components/utils/form-error';
import toast from 'react-hot-toast';
import { useNotify } from '../components/hooks/use-notify';

export default function Contact() {
    const notify = useNotify();

    useEffect(() => {
        // Initialize Leaflet map
        const mymap = L.map("mapid").setView([-23.013104, -43.394365], 13);

        L.tileLayer(
          "https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw",
          {
            maxZoom: 18,
            attribution:
              'Zay Template | Template Design by <a href="https://templatemo.com/">Templatemo</a> | Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
              '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
              'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            id: "mapbox/streets-v11",
            tileSize: 512,
            zoomOffset: -1,
          }
        ).addTo(mymap);

        L.marker([-23.013104, -43.394365])
          .addTo(mymap)
          .bindPopup("<b>Zay</b> eCommerce Template<br />Location.")
          .openPopup();

        mymap.scrollWheelZoom.disable();
        mymap.touchZoom.disable();
      }, []);

    const { data, setData, post, processing, errors, reset } = useForm({
        name: "",
        email: "",
        subject: "",
        message: "",
    });

    const handleChange = (e) => {
        setData(e.target.name, e.target.value);
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        post(route("contact.store"), {
            onSuccess: () => {
                notify('success', 'Message sent successfully');
                reset();
            },
            onError: (err) => {
                console.log(err);
                notify('error', 'Some Validation Error');
            },
            onFinish: () => {
                console.log('Finished');
            },
            preserveScroll: true,
            preserveState: true,
        });
    };

    return (
        <HomeLayout>
            {/* Start Content Page */}
            <div className="container-fluid bg-light py-5">
                <div className="col-md-6 m-auto text-center">
                <h1 className="h1">Contact Us</h1>
                <p>
                    Proident, sunt in culpa qui officia deserunt mollit anim id est
                    laborum. Lorem ipsum dolor sit amet.
                </p>
                </div>
            </div>

            {/* Start Map */}
            <div id="mapid" style={{ width: "100%", height: "300px" }}></div>
            {/* End Map */}

            {/* Start Contact */}
            <div className="container py-5">
                <div className="row py-5">
                <form className="col-md-9 m-auto" onSubmit={handleSubmit}>
                    <div className="row">
                    <div className="form-group col-md-6 mb-3">
                        <label htmlFor="name">Name</label>
                        <input
                        type="text"
                        className="form-control mt-1"
                        id="name"
                        value={data.name}
                        name="name"
                        onChange={handleChange}
                        placeholder="Name"
                        />
                        { errors.name && <FormErrorInput message={errors.name} />}
                    </div>
                    <div className="form-group col-md-6 mb-3">
                        <label htmlFor="email">Email</label>
                        <input
                        type="text"
                        className="form-control mt-1"
                        id="email"
                        value={data.email}
                        name="email"
                        onChange={handleChange}

                        placeholder="Email"
                        />
                        { errors.email && <FormErrorInput message={errors.email} />}
                    </div>
                    </div>
                    <div className="mb-3">
                    <label htmlFor="subject">Subject</label>
                    <input
                        type="text"
                        className="form-control mt-1"
                        id="subject"
                        value={data.subject}
                        name="subject"
                        onChange={handleChange}

                        placeholder="Subject"
                    />
                    { errors.subject && <FormErrorInput message={errors.subject} />}
                    </div>
                    <div className="mb-3">
                    <label htmlFor="message">Message</label>
                    { errors.message && <FormErrorInput message={errors.message} />}
                    <textarea
                        className="form-control mt-1"
                        id="message"
                        name="message"
                        value={data.message}
                        onChange={handleChange}
                        placeholder="Message"
                        rows="8"
                    ></textarea>
                    </div>
                    <div className="row">
                    <div className="col text-end mt-2">
                        <button
                        type="submit"
                        disabled={processing}
                        className="btn btn-success btn-lg px-3"
                        >
                        {processing ? "Sending..." : "Let’s Talk"}
                        </button>
                    </div>
                    </div>
                </form>
                </div>
            </div>
            {/* End Contact */}
        </HomeLayout>
    )
}



