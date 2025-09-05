import { Link } from '@inertiajs/react';
import React from 'react';

export default function Navbar() {
    return (
        <div>
            <nav className="navbar navbar-expand-lg bg-dark navbar-light d-none d-lg-block" id="templatemo_nav_top">
                <div className="container text-light">
                <div className="w-100 d-flex justify-content-between">
                    <div>
                    <i className="fa fa-envelope mx-2" />
                    <a className="navbar-sm-brand text-light text-decoration-none" href="mailto:info@company.com">info@company.com</a>
                    <i className="fa fa-phone mx-2" />
                    <a className="navbar-sm-brand text-light text-decoration-none" href="tel:010-020-0340">010-020-0340</a>
                    </div>
                    <div>
                    <a className="text-light" href="https://fb.com/templatemo" target="_blank" rel="sponsored"><i className="fab fa-facebook-f fa-sm fa-fw me-2" /></a>
                    <a className="text-light" href="https://www.instagram.com/" target="_blank"><i className="fab fa-instagram fa-sm fa-fw me-2" /></a>
                    <a className="text-light" href="https://twitter.com/" target="_blank"><i className="fab fa-twitter fa-sm fa-fw me-2" /></a>
                    <a className="text-light" href="https://www.linkedin.com/" target="_blank"><i className="fab fa-linkedin fa-sm fa-fw" /></a>
                    </div>
                </div>
                </div>
            </nav>
            <nav className="navbar navbar-expand-lg navbar-light shadow">
                <div className="container d-flex justify-content-between align-items-center">
                <a className="navbar-brand text-success logo h1 align-self-center" href="http://localhost:8000">
                    Zay
                </a>
                <button className="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon" />
                </button>
                <div className="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                    <div className="flex-fill">
                    <ul className="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li className="nav-item">
                        <link as="a" className="nav-link" href="{route('home')}" />Home
                        </li>
                        <li className="nav-item">
                        <link as="a" className="nav-link" href="{route('about')}" />About
                        </li>
                        <li className="nav-item">
                        <link as="a" className="nav-link" href="{route('products')}" />Shop
                        </li>
                        <li className="nav-item">
                        <link as="a" className="nav-link" href="{route('contact')}" />Contact
                        </li>
                    </ul>
                    </div>
                    <div className="navbar align-self-center d-flex">
                    <div className="d-lg-none flex-sm-fill mt-3 mb-4 col-7 col-sm-auto pr-3">
                    </div>
                    <link as="a" className="nav-icon position-relative text-decoration-none" href="{route('user.login')}" />
                    Login
                    <link as="a" className="nav-icon position-relative text-decoration-none" href="{route('user.register')}" />
                    Register
                    </div>
                </div>
                </div>
            </nav>
        </div>
    )
}
