import { Head, usePage } from '@inertiajs/react';
import React, { createContext } from 'react';
import { Footer, Navbar } from '../components/utils';
import { Toaster } from 'react-hot-toast';
export default function HomeLayout({ children }) {
    return (
        <>
            <Head>
            </Head>

                <Navbar />
                    <section>
                        {children}
                    </section>
                <Footer />
                <Toaster position="top-right" reverseOrder={false} />

        </>
    )
}

