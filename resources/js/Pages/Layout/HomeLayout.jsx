import { Head } from '@inertiajs/react';
import React from 'react';
import { Footer, Navbar } from '../components/utils';

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
        </>
    )
}

