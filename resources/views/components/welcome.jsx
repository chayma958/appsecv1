import React, { useState, useEffect } from "react";
import "../../css/app.css";

import { Link, Head } from '@inertiajs/react';
import { Header } from "../Components1/header";
import { Features } from "../Components1/features";
import { About } from "../Components1/about";
import { Services } from "../Components1/services";

import { Contact } from "../Components1/contact";
import JsonData from "../data/data.json";
import SmoothScroll from "smooth-scroll";

export const scroll = new SmoothScroll('a[href*="#"]', {
    speed: 1000,
    speedAsDuration: true,
  });

export default function Welcome({ auth, laravelVersion, phpVersion }) {
    const [landingPageData, setLandingPageData] = useState({});
    useEffect(() => {
      setLandingPageData(JsonData);
    }, []);
    const handleImageError = () => {
        document.getElementById('screenshot-container')?.classList.add('!hidden');
        document.getElementById('docs-card')?.classList.add('!row-span-1');
        document.getElementById('docs-card-content')?.classList.add('!flex-row');
        document.getElementById('background')?.classList.add('!hidden');
    };

    return (
        <>
            <Head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
  <link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
  <link
    rel="apple-touch-icon"
    sizes="72x72"
    href="img/apple-touch-icon-72x72.png"
  />
  <link
    rel="apple-touch-icon"
    sizes="114x114"
    href="img/apple-touch-icon-114x114.png"
  />

  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link
    rel="stylesheet"
    type="text/css"
    href="fonts/font-awesome/css/font-awesome.css"
  />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link
    rel="stylesheet"
    type="text/css"
    href="css/nivo-lightbox/nivo-lightbox.css"
  />
  <link rel="stylesheet" type="text/css" href="css/nivo-lightbox/default.css" />
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css?family=Lato:400,700"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700,800,900"
    rel="stylesheet"
  />
  <title>SecurityApp</title>
  <meta name="description" content="" />
  <meta name="author" content="@Issaafalkattan" />
</Head>
<div>
<nav id="menu" className="navbar navbar-default navbar-fixed-top ">
      <div className="container">
        <div className="navbar-header">
            

          <button
            type="button"
            className="navbar-toggle collapsed"
            data-toggle="collapse"
            data-target="#bs-example-navbar-collapse-1"
          >
            {" "}
            <span className="sr-only">Toggle navigation</span>{" "}
            <span className="icon-bar"></span>{" "}
            <span className="icon-bar"></span>{" "}
            <span className="icon-bar"></span>{" "}
          </button>
          <img src="img/logo.png" alt="" className="logo"/>{" "}

          <a className="navbar-brand page-scroll " href="#page-top" style={{ textTransform: 'none' }}>
            SecurityApp
          </a>{" "}
        </div>
        <div className="-mx-3 flex flex-1 justify-end"
        style={{position:'relative',
            right:'-100px'
        }}>
                                {auth.user ? (
                                    <Link
                                        href={route('dashboard')}
                                        className="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                                    >
                                        
                                    </Link>
                                ) : (
                                    <>
                                    
                                        <Link
                                            href={route('login')}
                                            style={{ fontSize: '20px'}}
                                            className="rounded-md px-7 py-7 text-black ring-1 ring-transparent transition duration-300 hover:text-blue-900 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-blue-500 dark:focus-visible:ring-black"
                                            >
                                            Log in
                                        </Link>
                                        <Link
                                            href={route('register')}
                                            style={{ fontSize: '20px'}}
                                            className="rounded-md px-3 py-7 text-black ring-1 ring-transparent transition duration-300 hover:text-blue-900 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-black dark:hover:text-blue-500 dark:focus-visible:ring-black"
                                            >
                                            Register
                                        </Link>
                                    </>
                                )}
                                </div>
                                </div>
</nav>
</div>
<div>
      <Header data={landingPageData.Header}  />
      <Features data={landingPageData.Features} />
      <About data={landingPageData.About} />
      <Services data={landingPageData.Services} />
      <Contact data={landingPageData.Contact} />
      </div>

            
          

                        <main className="mt-6">
  <div id="root"></div>
  <script type="text/javascript" src="js/jquery.1.11.1.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

                        </main>
                  
        </>
    );
}