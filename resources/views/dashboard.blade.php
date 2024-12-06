<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 text-center leading-tight" style="display: flex; justify-content:center; ">
           Bienvenue sur la page de la mairie de {{ Auth::user()->commune }}
        </div>
    </x-slot>
    <!DOCTYPE html>
    <html lang="en">
    
    <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Service Details - EstateAgency Bootstrap Template</title>
      <meta name="description" content="">
      <meta name="keywords" content="">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      
      
        <!-- Favicons -->
    
    
    <!-- Fonts -->
     <link rel="icon" href="haut.png">
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    
    
      <!-- =======================================================
      * Template Name: EstateAgency
      * Template URL: https://bootstrapmade.com/real-estate-agency-bootstrap-template/
      * Updated: Aug 09 2024 with Bootstrap v5.3.3
      * Author: BootstrapMade.com
      * License: https://bootstrapmade.com/license/
      ======================================================== -->
    </head>
    
    <body class="service-details-page">
        <style>
            /**
    * Template Name: EstateAgency
    * Template URL: https://bootstrapmade.com/real-estate-agency-bootstrap-template/
    * Updated: Aug 09 2024 with Bootstrap v5.3.3
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    */
    
    /*--------------------------------------------------------------
    # Font & Color Variables
    # Help: https://bootstrapmade.com/color-system/
    --------------------------------------------------------------*/
    /* Fonts */
    :root {
      --default-font: "Roboto",  system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      --heading-font: "Raleway",  sans-serif;
      --nav-font: "Poppins",  sans-serif;
    }
    
    /* Global Colors - The following color variables are used throughout the website. Updating them here will change the color scheme of the entire website */
    :root { 
      --background-color: #ffffff; /* Background color for the entire website, including individual sections */
      --default-color: #444444; /* Default color used for the majority of the text content across the entire website */
      --heading-color: #1b1b1b; /* Color for headings, subheadings and title throughout the website */
      --accent-color: #2eca6a; /* Accent color that represents your brand on the website. It's used for buttons, links, and other elements that need to stand out */
      --surface-color: #ffffff; /* The surface color is used as a background of boxed elements within sections, such as cards, icon boxes, or other elements that require a visual separation from the global background. */
      --contrast-color: #ffffff; /* Contrast color for text, ensuring readability against backgrounds of accent, heading, or default colors. */
    }
    .service-details .services-list a.active {
        color: black var(--contrast-color);
        background-color: #ffffff var(--accent-color);
    }
    
    /* Nav Menu Colors - The following color variables are used specifically for the navigation menu. They are separate from the global colors to allow for more customization options */
    :root {
      --nav-color: #444444;  /* The default color of the main navmenu links */
      --nav-hover-color: #000000; /* Applied to section navmenu links when they are hovered over or active */
      --nav-mobile-background-color: #ffffff; /* Used as the background color for mobile navigation menu */
      --nav-dropdown-background-color: #ffffff; /* Used as the background color for dropdown items that appear when hovering over primary navigation items */
      --nav-dropdown-color: #444444; /* Used for navigation links of the dropdown items in the navigation menu. */
      --nav-dropdown-hover-color: #2eca6a; /* Similar to --nav-hover-color, this color is applied to dropdown navigation links when they are hovered over. */
    }
    
    /* Color Presets - These classes override global colors when applied to any section or element, providing reuse of the sam color scheme. */
    
    .light-background {
      --background-color: #f9f9f9;
      --surface-color: #ffffff;
    }
    
    .dark-background {
      --background-color: #060606;
      --default-color: #ffffff;
      --heading-color: #ffffff;
      --surface-color: #252525;
      --contrast-color: #ffffff;
    }
    
    /* Smooth scroll */
    :root {
      scroll-behavior: smooth;
    }
    
    /*--------------------------------------------------------------
    # General Styling & Shared Classes
    --------------------------------------------------------------*/
    body {
      color: var(--default-color);
      background-color: var(--background-color);
      font-family: var(--default-font);
    }
    
    a {
      color: var(--accent-color);
      text-decoration: none;
      transition: 0.3s;
    }
    
    a:hover {
      color: color-mix(in srgb, var(--accent-color), transparent 25%);
      text-decoration: none;
    }
    
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      color: var(--heading-color);
      font-family: var(--heading-font);
    }
    
    /* PHP Email Form Messages
    ------------------------------*/
    .php-email-form .error-message {
      display: none;
      background: #df1529;
      color: #ffffff;
      text-align: left;
      padding: 15px;
      margin-bottom: 24px;
      font-weight: 600;
    }
    
    .php-email-form .sent-message {
      display: none;
      color: #ffffff;
      background: #059652;
      text-align: center;
      padding: 15px;
      margin-bottom: 24px;
      font-weight: 600;
    }
    
    .php-email-form .loading {
      display: none;
      background: var(--surface-color);
      text-align: center;
      padding: 15px;
      margin-bottom: 24px;
    }
    
    .php-email-form .loading:before {
      content: "";
      display: inline-block;
      border-radius: 50%;
      width: 24px;
      height: 24px;
      margin: 0 10px -6px 0;
      border: 3px solid var(--accent-color);
      border-top-color: var(--surface-color);
      animation: php-email-form-loading 1s linear infinite;
    }
    
    @keyframes php-email-form-loading {
      0% {
        transform: rotate(0deg);
      }
    
      100% {
        transform: rotate(360deg);
      }
    }
    
    /*--------------------------------------------------------------
    # Global Header
    --------------------------------------------------------------*/
    
    
    .header .logo {
      line-height: 1;
    }
    
    .header .logo img {
      max-height: 32px;
      margin-right: 8px;
    }
    
    .header .logo h1 {
      font-size: 30px;
      margin: 0;
      font-weight: 700;
      color: var(--heading-color);
    }
    
    .header .logo h1 span {
      color: var(--accent-color);
    }
    
    /*--------------------------------------------------------------
    # Navigation Menu
    --------------------------------------------------------------*/
    /* Desktop Navigation */
    @media (min-width: 1200px) {
      .navmenu {
        padding: 0;
      }
    
      .navmenu ul {
        margin: 0;
        padding: 0;
        display: flex;
        list-style: none;
        align-items: center;
      }
    
      .navmenu li {
        position: relative;
      }
    
      .navmenu>ul>li {
        white-space: nowrap;
        padding: 15px 14px;
      }
    
      .navmenu>ul>li:last-child {
        padding-right: 0;
      }
    
      .navmenu a,
      .navmenu a:focus {
        color: var(--nav-color);
        font-size: 16px;
        padding: 0 2px;
        font-family: var(--nav-font);
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: space-between;
        white-space: nowrap;
        transition: 0.3s;
        position: relative;
      }
    
      .navmenu a i,
      .navmenu a:focus i {
        font-size: 12px;
        line-height: 0;
        margin-left: 5px;
        transition: 0.3s;
      }
    
      .navmenu>ul>li>a:before {
        content: "";
        position: absolute;
        width: 100%;
        height: 2px;
        bottom: -6px;
        left: 0;
        background-color: var(--accent-color);
        visibility: hidden;
        width: 0px;
        transition: all 0.3s ease-in-out 0s;
      }
    
      .navmenu a:hover:before,
      .navmenu li:hover>a:before,
      .navmenu .active:before {
        visibility: visible;
        width: 100%;
      }
    
      .navmenu li:hover>a,
      .navmenu .active,
      .navmenu .active:focus {
        color: var(--nav-hover-color);
      }
    
      .navmenu .dropdown ul {
        margin: 0;
        padding: 10px 0;
        background: var(--nav-dropdown-background-color);
        display: block;
        position: absolute;
        visibility: hidden;
        left: 14px;
        top: 130%;
        opacity: 0;
        transition: 0.3s;
        border-radius: 4px;
        z-index: 99;
        box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.1);
      }
    
      .navmenu .dropdown ul li {
        min-width: 200px;
      }
    
      .navmenu .dropdown ul a {
        padding: 10px 20px;
        font-size: 15px;
        text-transform: none;
        color: var(--nav-dropdown-color);
      }
    
      .navmenu .dropdown ul a i {
        font-size: 12px;
      }
    
      .navmenu .dropdown ul a:hover,
      .navmenu .dropdown ul .active:hover,
      .navmenu .dropdown ul li:hover>a {
        color: var(--nav-dropdown-hover-color);
      }
    
      .navmenu .dropdown:hover>ul {
        opacity: 1;
        top: 100%;
        visibility: visible;
      }
    
      .navmenu .dropdown .dropdown ul {
        top: 0;
        left: -90%;
        visibility: hidden;
      }
    
      .navmenu .dropdown .dropdown:hover>ul {
        opacity: 1;
        top: 0;
        left: -100%;
        visibility: visible;
      }
    }
    
    /* Mobile Navigation */
    @media (max-width: 1199px) {
      .mobile-nav-toggle {
        color: var(--nav-color);
        font-size: 28px;
        line-height: 0;
        margin-right: 10px;
        cursor: pointer;
        transition: color 0.3s;
      }
    
      .navmenu {
        padding: 0;
        z-index: 9997;
      }
    
      .navmenu ul {
        display: none;
        list-style: none;
        position: absolute;
        inset: 60px 20px 20px 20px;
        padding: 10px 0;
        margin: 0;
        border-radius: 6px;
        background-color: var(--nav-mobile-background-color);
        border: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
        box-shadow: none;
        overflow-y: auto;
        transition: 0.3s;
        z-index: 9998;
      }
    
      .navmenu a,
      .navmenu a:focus {
        color: var(--nav-dropdown-color);
        padding: 10px 20px;
        font-family: var(--nav-font);
        font-size: 17px;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: space-between;
        white-space: nowrap;
        transition: 0.3s;
      }
    
      .navmenu a i,
      .navmenu a:focus i {
        font-size: 12px;
        line-height: 0;
        margin-left: 5px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        transition: 0.3s;
        background-color: color-mix(in srgb, var(--accent-color), transparent 90%);
      }
    
      .navmenu a i:hover,
      .navmenu a:focus i:hover {
        background-color: var(--accent-color);
        color: var(--contrast-color);
      }
    
      .navmenu a:hover,
      .navmenu .active,
      .navmenu .active:focus {
        color: var(--nav-dropdown-hover-color);
      }
    
      .navmenu .active i,
      .navmenu .active:focus i {
        background-color: var(--accent-color);
        color: var(--contrast-color);
        transform: rotate(180deg);
      }
    
      .navmenu .dropdown ul {
        position: static;
        display: none;
        z-index: 99;
        padding: 10px 0;
        margin: 10px 20px;
        background-color: var(--nav-dropdown-background-color);
        transition: all 0.5s ease-in-out;
      }
    
      .navmenu .dropdown ul ul {
        background-color: rgba(33, 37, 41, 0.1);
      }
    
      .navmenu .dropdown>.dropdown-active {
        display: block;
        background-color: rgba(33, 37, 41, 0.03);
      }
    
      .mobile-nav-active {
        overflow: hidden;
      }
    
      .mobile-nav-active .mobile-nav-toggle {
        color: #fff;
        position: absolute;
        font-size: 32px;
        top: 15px;
        right: 15px;
        margin-right: 0;
        z-index: 9999;
      }
    
      .mobile-nav-active .navmenu {
        position: fixed;
        overflow: hidden;
        inset: 0;
        background: rgba(33, 37, 41, 0.8);
        transition: 0.3s;
      }
    
      .mobile-nav-active .navmenu>ul {
        display: block;
      }
    }
    
    /*--------------------------------------------------------------
    # Global Footer
    --------------------------------------------------------------*/
    .footer {
      color: var(--default-color);
      background-color: var(--background-color);
      font-size: 14px;
      padding: 40px 0 0 0;
      position: relative;
    }
    
    .footer .icon {
      color: var(--accent-color);
      margin-right: 15px;
      font-size: 24px;
      line-height: 0;
    }
    
    .footer h4 {
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 15px;
    }
    
    .footer .address p {
      margin-bottom: 0px;
    }
    
    .footer .social-links a {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 50%;
      border: 1px solid color-mix(in srgb, var(--default-color), transparent 50%);
      font-size: 16px;
      color: color-mix(in srgb, var(--default-color), transparent 50%);
      margin-right: 10px;
      transition: 0.3s;
    }
    
    .footer .social-links a:hover {
      color: var(--accent-color);
      border-color: var(--accent-color);
    }
    
    .footer .copyright {
      padding: 25px 0;
      border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
    }
    
    .footer .copyright p {
      margin-bottom: 0;
    }
    
    .footer .credits {
      margin-top: 5px;
      font-size: 13px;
    }
    
    /*--------------------------------------------------------------
    # Preloader
    --------------------------------------------------------------*/
    #preloader {
      position: fixed;
      inset: 0;
      z-index: 999999;
      overflow: hidden;
      background: var(--background-color);
      transition: all 0.6s ease-out;
    }
    
    #preloader:before {
      content: "";
      position: fixed;
      top: calc(50% - 30px);
      left: calc(50% - 30px);
      border: 6px solid #ffffff;
      border-color: var(--accent-color) transparent var(--accent-color) transparent;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: animate-preloader 1.5s linear infinite;
    }
    
    @keyframes animate-preloader {
      0% {
        transform: rotate(0deg);
      }
    
      100% {
        transform: rotate(360deg);
      }
    }
    
    /*--------------------------------------------------------------
    # Scroll Top Button
    --------------------------------------------------------------*/
    .scroll-top {
      position: fixed;
      visibility: hidden;
      opacity: 0;
      right: 15px;
      bottom: 15px;
      z-index: 99999;
      background-color: var(--accent-color);
      width: 40px;
      height: 40px;
      border-radius: 4px;
      transition: all 0.4s;
    }
    
    
    .scroll-top i {
      font-size: 24px;
      color: var(--contrast-color);
      line-height: 0;
    }
    
    .scroll-top:hover {
      background-color: color-mix(in srgb, var(--accent-color), transparent 20%);
      color: var(--contrast-color);
    }
    
    .scroll-top.active {
      visibility: visible;
      opacity: 1;
    }
    
    /*--------------------------------------------------------------
    # Disable aos animation delay on mobile devices
    --------------------------------------------------------------*/
    @media screen and (max-width: 768px) {
      [data-aos-delay] {
        transition-delay: 0 !important;
      }
    }
    
    /*--------------------------------------------------------------
    # Global Page Titles & Breadcrumbs
    --------------------------------------------------------------*/
    .page-title {
      color: var(--default-color);
      background-color: var(--background-color);
      position: relative;
    }
    
    
    .page-title .heading h1 {
      font-size: 38px;
      font-weight: 700;
    }
    
    .page-title nav {
      background-color: color-mix(in srgb, var(--default-color), transparent 95%);
      padding: 20px 0;
    }
    
    .page-title nav ol {
      display: flex;
      flex-wrap: wrap;
      list-style: none;
      margin: 0;
      font-size: 16px;
      font-weight: 600;
    }
    
    .page-title nav ol li+li {
      padding-left: 10px;
    }
    
    .page-title nav ol li+li::before {
      content: "/";
      display: inline-block;
      padding-right: 10px;
      color: color-mix(in srgb, var(--default-color), transparent 70%);
    }
    
    /*--------------------------------------------------------------
    # Global Sections
    --------------------------------------------------------------*/
    section,
    .section {
      color: var(--default-color);
      background-image: url({{ asset('assets/images/profiles/arriereP.jpg') }});
      padding: 60px 0;
      scroll-margin-top: 90px;
      overflow: clip;
    }
    
    @media (max-width: 1199px) {
    
      section,
      .section {
        scroll-margin-top: 66px;
      }
    }
    
    /*--------------------------------------------------------------
    # Global Section Titles
    --------------------------------------------------------------*/
    .section-title {
      text-align: center;
      padding-bottom: 60px;
      position: relative;
    }
    
    .section-title h2 {
      font-size: 32px;
      font-weight: 700;
      margin-bottom: 15px;
    }
    
    .section-title p {
      margin-bottom: 0;
    }
    
    /*--------------------------------------------------------------
    # Hero Section
    --------------------------------------------------------------*/
    .hero {
      padding: 0;
    }
    
    .hero .carousel {
      width: 100%;
      min-height: 100vh;
      padding: 0;
      margin: 0;
      background-color: var(--background-color);
      position: relative;
      overflow: hidden;
    }
    
    .hero img {
      position: absolute;
      inset: 0;
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 1;
    }
    
    .hero .carousel-item {
      position: absolute;
      inset: 0;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      overflow: hidden;
    }
    
    .hero .carousel-item:before {
      content: "";
      background: color-mix(in srgb, var(--background-color), transparent 60%);
      position: absolute;
      inset: 0;
      z-index: 2;
    }
    
    .hero .carousel-container {
      position: absolute;
      inset: 90px 100px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      z-index: 3;
    }
    
    @media (max-width: 575px) {
      .hero .carousel-container {
        inset: 90px 50px;
      }
    }
    
    .hero h2 {
      margin-bottom: 30px;
      font-size: 56px;
      font-weight: 900;
      text-transform: uppercase;
    }
    
    .hero h2 span {
      color: var(--accent-color);
    }
    
    @media (max-width: 768px) {
      .hero h2 {
        font-size: 30px;
      }
    }
    
    .hero .btn-get-started {
      color: var(--contrast-color);
      font-family: var(--heading-font);
      font-weight: 600;
      font-size: 18px;
      letter-spacing: 1px;
      text-transform: uppercase;
      display: inline-block;
      padding: 10px 40px;
      border-radius: 50px;
      transition: 0.5s;
      margin: 10px 0;
      align-self: flex-start;
      flex-shrink: 0;
      border: 2px solid var(--accent-color);
    }
    
    .hero .btn-get-started:hover {
      background: color-mix(in srgb, var(--accent-color), transparent 20%);
    }
    
    .hero .carousel-control-prev,
    .hero .carousel-control-next {
      width: 10%;
      transition: 0.3s;
      opacity: 0.5;
      z-index: 3;
    }
    
    .hero .carousel-control-prev:focus,
    .hero .carousel-control-next:focus {
      opacity: 0.5;
    }
    
    .hero .carousel-control-prev:hover,
    .hero .carousel-control-next:hover {
      opacity: 0.9;
    }
    
    @media (min-width: 1024px) {
    
      .hero .carousel-control-prev,
      .hero .carousel-control-next {
        width: 5%;
      }
    }
    
    .hero .carousel-control-next-icon,
    .hero .carousel-control-prev-icon {
      background: none;
      font-size: 32px;
      line-height: 1;
    }
    
    .hero .carousel-indicators {
      list-style: none;
    }
    
    .hero .carousel-indicators li {
      cursor: pointer;
      opacity: 1;
      height: 6px;
      width: 20px;
      transition: 0.3s;
      padding: 0;
    }
    
    .hero .carousel-indicators .active {
      background-color: var(--accent-color);
      width: 40px;
    }
    
    /*--------------------------------------------------------------
    # Services Section
    --------------------------------------------------------------*/
    .services .service-item {
      background-color: var(--surface-color);
      box-shadow: 0px 5px 90px 0px rgba(0, 0, 0, 0.1);
      padding: 60px 30px;
      transition: all ease-in-out 0.3s;
      border-radius: 18px;
      border-bottom: 5px solid var(--surface-color);
      height: 100%;
    }
    
    .services .service-item .icon {
      color: var(--contrast-color);
      background: var(--accent-color);
      margin: 0;
      width: 64px;
      height: 64px;
      border-radius: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 20px;
      font-size: 28px;
      transition: ease-in-out 0.3s;
    }
    
    .services .service-item h3 {
      font-weight: 700;
      margin: 10px 0 15px 0;
      font-size: 22px;
      transition: ease-in-out 0.3s;
    }
    
    .services .service-item p {
      line-height: 24px;
      font-size: 14px;
      margin-bottom: 0;
    }
    
    @media (min-width: 1365px) {
      .services .service-item:hover {
        transform: translateY(-10px);
        border-color: var(--accent-color);
      }
    
      .services .service-item:hover h3 {
        color: var(--accent-color);
      }
    }
    
    /*--------------------------------------------------------------
    # Agents Section
    --------------------------------------------------------------*/
    .agents .member {
      position: relative;
    }
    
    .agents .member .pic {
      overflow: hidden;
      margin-bottom: 50px;
    }
    
    .agents .member .member-info {
      background-color: var(--surface-color);
      color: color-mix(in srgb, var(--default-color), transparent 20%);
      box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
      position: absolute;
      bottom: -50px;
      left: 20px;
      right: 20px;
      padding: 20px 15px;
      overflow: hidden;
      transition: 0.5s;
    }
    
    .agents .member h4 {
      font-weight: 700;
      margin-bottom: 10px;
      font-size: 16px;
      position: relative;
      padding-bottom: 10px;
    }
    
    .agents .member h4::after {
      content: "";
      position: absolute;
      display: block;
      width: 50px;
      height: 1px;
      background: color-mix(in srgb, var(--default-color), transparent 60%);
      bottom: 0;
      left: 0;
    }
    
    .agents .member span {
      font-style: italic;
      display: block;
      font-size: 13px;
    }
    
    .agents .member .social {
      position: absolute;
      right: 15px;
      bottom: 15px;
    }
    
    .agents .member .social a {
      transition: color 0.3s;
      color: color-mix(in srgb, var(--default-color), transparent 70%);
    }
    
    .agents .member .social a:hover {
      color: var(--accent-color);
    }
    
    .agents .member .social i {
      font-size: 16px;
      margin: 0 2px;
    }
    
    /*--------------------------------------------------------------
    # Testimonials Section
    --------------------------------------------------------------*/
    .testimonials .testimonial-item {
      background-color: var(--surface-color);
      box-shadow: 0px 0 20px rgba(0, 0, 0, 0.1);
      box-sizing: content-box;
      padding: 30px;
      margin: 40px 30px;
      min-height: 320px;
      display: flex;
      flex-direction: column;
      text-align: center;
      transition: 0.3s;
    }
    
    .testimonials .testimonial-item .stars {
      margin-bottom: 15px;
    }
    
    .testimonials .testimonial-item .stars i {
      color: #ffc107;
      margin: 0 1px;
    }
    
    .testimonials .testimonial-item .testimonial-img {
      width: 90px;
      border-radius: 50%;
      border: 4px solid var(--background-color);
      margin: 0 auto;
    }
    
    .testimonials .testimonial-item h3 {
      font-size: 18px;
      font-weight: bold;
      margin: 10px 0 5px 0;
    }
    
    .testimonials .testimonial-item h4 {
      font-size: 14px;
      color: color-mix(in srgb, var(--default-color), transparent 40%);
      margin: 0;
    }
    
    .testimonials .testimonial-item p {
      font-style: italic;
      margin: 0 auto 15px auto;
    }
    
    .testimonials .swiper-wrapper {
      height: auto;
    }
    
    .testimonials .swiper-pagination {
      margin-top: 20px;
      position: relative;
    }
    
    .testimonials .swiper-pagination .swiper-pagination-bullet {
      width: 12px;
      height: 12px;
      background-color: color-mix(in srgb, var(--default-color), transparent 85%);
      opacity: 1;
    }
    
    .testimonials .swiper-pagination .swiper-pagination-bullet-active {
      background-color: var(--accent-color);
    }
    
    .testimonials .swiper-slide {
      opacity: 0.3;
    }
    
    @media (max-width: 1199px) {
      .testimonials .swiper-slide-active {
        opacity: 1;
      }
    
      .testimonials .swiper-pagination {
        margin-top: 0;
      }
    
      .testimonials .testimonial-item {
        margin: 40px 20px;
      }
    }
    
    @media (min-width: 1200px) {
      .testimonials .swiper-slide-next {
        opacity: 1;
        transform: scale(1.12);
      }
    }
    
    /*--------------------------------------------------------------
    # About Section
    --------------------------------------------------------------*/
    .about .content .who-we-are {
      text-transform: uppercase;
      margin-bottom: 15px;
      color: color-mix(in srgb, var(--default-color), transparent 40%);
    }
    
    .about .content h3 {
      font-size: 2rem;
      font-weight: 700;
    }
    
    .about .content ul {
      list-style: none;
      padding: 0;
    }
    
    .about .content ul li {
      padding-bottom: 10px;
    }
    
    .about .content ul i {
      font-size: 1.25rem;
      margin-right: 4px;
      color: var(--accent-color);
    }
    
    .about .content p:last-child {
      margin-bottom: 0;
    }
    
    .about .content .read-more {
      background: var(--accent-color);
      color: var(--contrast-color);
      font-family: var(--heading-font);
      font-weight: 500;
      font-size: 16px;
      letter-spacing: 1px;
      padding: 12px 24px;
      border-radius: 5px;
      transition: 0.3s;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }
    
    .about .content .read-more i {
      font-size: 18px;
      margin-left: 5px;
      line-height: 0;
      transition: 0.3s;
    }
    
    .about .content .read-more:hover {
      background: color-mix(in srgb, var(--accent-color), transparent 20%);
      padding-right: 19px;
    }
    
    .about .content .read-more:hover i {
      margin-left: 10px;
    }
    
    .about .about-images img {
      border-radius: 10px;
    }
    
    /*--------------------------------------------------------------
    # Stats Section
    --------------------------------------------------------------*/
    .stats .stats-item {
      background-color: var(--surface-color);
      box-shadow: 0px 0 30px rgba(0, 0, 0, 0.1);
      padding: 30px;
    }
    
    .stats .stats-item i {
      color: var(--accent-color);
      font-size: 42px;
      line-height: 0;
      margin-right: 20px;
    }
    
    .stats .stats-item span {
      color: var(--heading-color);
      font-size: 36px;
      display: block;
      font-weight: 600;
    }
    
    .stats .stats-item p {
      padding: 0;
      margin: 0;
      font-family: var(--heading-font);
      font-size: 16px;
    }
    
    /*--------------------------------------------------------------
    # Features Section
    --------------------------------------------------------------*/
    .features .features-image {
      position: relative;
      min-height: 400px;
    }
    
    .features .features-image img {
      position: absolute;
      inset: 0;
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 1;
    }
    
    .features h3 {
      font-size: 28px;
      font-weight: 700;
      margin-bottom: 20px;
      padding-bottom: 20px;
      position: relative;
    }
    
    .features h3:after {
      content: "";
      background: var(--accent-color);
      position: absolute;
      display: block;
      width: 50px;
      height: 3px;
      left: 0;
      bottom: 0;
    }
    
    .features .icon-box {
      margin-top: 50px;
    }
    
    .features .icon-box i {
      color: var(--accent-color);
      background-color: var(--surface-color);
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 25px;
      font-size: 28px;
      width: 56px;
      height: 56px;
      border-radius: 4px;
      line-height: 0;
      box-shadow: 0px 2px 30px rgba(0, 0, 0, 0.1);
      transition: 0.3s;
    }
    
    .features .icon-box:hover i {
      background-color: var(--accent-color);
      color: var(--contrast-color);
    }
    
    .features .icon-box h4 {
      font-weight: 700;
      margin-bottom: 10px;
      font-size: 18px;
    }
    
    .features .icon-box h4 a {
      color: var(--heading-color);
      transition: 0.3s;
    }
    a{
      color: white;
    }
    
    .features .icon-box h4 a:hover {
      color: var(--accent-color);
    }
    
    .features .icon-box p {
      line-height: 24px;
      font-size: 14px;
      margin-bottom: 0;
    }
    
    /*--------------------------------------------------------------
    # Service Details Section
    --------------------------------------------------------------*/
    .service-details .service-box {
        
      background-color: var(--surface-color);
      padding: 20px;
      box-shadow: 0px 2px 20px rgba(0, 0, 0, 0.1);
      width: 400px;
      position: fixed;
      left: 100px;
    }
    .service-box{
        position: fixed;
    }
    .service-details .service-box+.service-box {
      margin-top: 30px;
    }
    
    .service-details .service-box h4 {
      font-size: 20px;
      font-weight: 700;
      border-bottom: 2px solid color-mix(in srgb, var(--default-color), transparent 92%);
      padding-bottom: 15px;
      margin-bottom: 15px;
    }
    
    .service-details .services-list {
      background-color: var(--surface-color);
    }
    
    .service-details .services-list a {
      color: color-mix(in srgb, var(--default-color), transparent 20%);
      background-color: color-mix(in srgb, var(--default-color), transparent 96%);
      display: flex;
      align-items: center;
      padding: 12px 15px;
      margin-top: 15px;
      transition: 0.3s;
    }
    
    .service-details .services-list a:first-child {
      margin-top: 0;
    }
    
    .service-details .services-list a i {
      font-size: 16px;
      margin-right: 8px;
      color: var(--accent-color);
    }
    
    .service-details .services-list a.active {
      color: var(--contrast-color);
      background-color: var(--accent-color);
    }
    
    .service-details .services-list a.active i {
      color: var(--contrast-color);
    }
    
    .service-details .services-list a:hover {
      background-color: color-mix(in srgb, var(--accent-color), transparent 95%);
      color: var(--accent-color);
    }
    
    .service-details .download-catalog a {
      color: var(--default-color);
      display: flex;
      align-items: center;
      padding: 10px 0;
      transition: 0.3s;
      border-top: 1px solid color-mix(in srgb, var(--default-color), transparent 90%);
    }
    
    .service-details .download-catalog a:first-child {
      border-top: 0;
      padding-top: 0;
    }
    
    .service-details .download-catalog a:last-child {
      padding-bottom: 0;
    }
    
    .service-details .download-catalog a i {
      font-size: 24px;
      margin-right: 8px;
      color: var(--accent-color);
    }
    
    .service-details .download-catalog a:hover {
      color: var(--accent-color);
    }
    
    .service-details .help-box {
      background-color: var(--accent-color);
      color: var(--contrast-color);
      margin-top: 30px;
      padding: 30px 15px;
    }
    
    .service-details .help-box .help-icon {
      font-size: 48px;
    }
    
    .service-details .help-box h4,
    .service-details .help-box a {
      color: var(--contrast-color);
    }
    
    .service-details .services-img {
      margin-bottom: 20px;
    }
    
    .service-details h3 {
      font-size: 26px;
      font-weight: 700;
    }
    
    .service-details p {
      font-size: 15px;
    }
    
    .service-details ul {
      list-style: none;
      padding: 0;
      font-size: 15px;
    }
    
    .service-details ul li {
      padding: 5px 0;
      display: flex;
      align-items: center;
    }
    
    .service-details ul i {
      font-size: 20px;
      margin-right: 8px;
      color: var(--accent-color);
    }
    
    /*--------------------------------------------------------------
    # Contact Section
    --------------------------------------------------------------*/
    .contact .info-item+.info-item {
      margin-top: 40px;
    }
    
    .contact .info-item i {
      color: var(--contrast-color);
      background: var(--accent-color);
      font-size: 20px;
      width: 44px;
      height: 44px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 4px;
      transition: all 0.3s ease-in-out;
      margin-right: 15px;
    }
    
    .contact .info-item h3 {
      padding: 0;
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 5px;
    }
    
    .contact .info-item p {
      padding: 0;
      margin-bottom: 0;
      font-size: 14px;
    }
    
    .contact .php-email-form {
      height: 100%;
    }
    
    .contact .php-email-form input[type=text],
    .contact .php-email-form input[type=email],
    .contact .php-email-form textarea {
      font-size: 14px;
      padding: 10px 15px;
      box-shadow: none;
      border-radius: 0;
      color: var(--default-color);
      background-color: color-mix(in srgb, var(--background-color), transparent 50%);
      border-color: color-mix(in srgb, var(--default-color), transparent 80%);
    }
    
    .contact .php-email-form input[type=text]:focus,
    .contact .php-email-form input[type=email]:focus,
    .contact .php-email-form textarea:focus {
      border-color: var(--accent-color);
    }
    
    .contact .php-email-form input[type=text]::placeholder,
    .contact .php-email-form input[type=email]::placeholder,
    .contact .php-email-form textarea::placeholder {
      color: color-mix(in srgb, var(--default-color), transparent 70%);
    }
    
    .contact .php-email-form button[type=submit] {
      color: var(--contrast-color);
      background: var(--accent-color);
      border: 0;
      padding: 10px 30px;
      transition: 0.4s;
      border-radius: 4px;
    }
    
    .contact .php-email-form button[type=submit]:hover {
      background: color-mix(in srgb, var(--accent-color), transparent 20%);
    }
    
    /*--------------------------------------------------------------
    # Real Estate Section
    --------------------------------------------------------------*/
    .real-estate .card {
      background-color: var(--background-color);
      color: var(--default-color);
      border: none;
      position: relative;
      border-radius: 0px;
      overflow: hidden;
      min-height: 500px;
    }
    
    .real-estate .card:before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(255, 255, 255, 0) 25%, rgba(0, 0, 0, 0.9) 75%);
      z-index: 2;
    }
    
    .real-estate .card img {
      position: absolute;
      inset: 0;
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: 1;
    }
    
    .real-estate .card .card-body {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 3;
      padding: 30px;
    }
    
    .real-estate .card .card-body .sale-rent {
      display: inline-block;
      font-size: 15px;
      font-weight: 500;
      color: var(--contrast-color);
      padding: 4px 20px;
      border: 2px solid var(--accent-color);
      border-radius: 50px;
      margin-bottom: 10px;
    }
    
    .real-estate .card .card-body h3 {
      font-weight: 700;
      font-size: 20px;
      margin-bottom: 0px;
      padding-left: 10px;
      border-left: 3px solid var(--accent-color);
    }
    
    .real-estate .card .card-body h3 a {
      color: var(--contrast-color);
    }
    
    .real-estate .card .card-body .card-content {
      background-color: var(--accent-color);
      color: var(--contrast-color);
      height: 80px;
      visibility: hidden;
      opacity: 0;
      margin-top: 10px;
      margin-bottom: -80px;
      margin-left: -30px;
      margin-right: -30px;
      transition: 0.3s;
      padding: 0 10px;
    }
    
    .real-estate .card .card-body .card-content .propery-info {
      font-weight: 500;
    }
    
    .real-estate .card:hover .card-content {
      margin-bottom: -30px;
      visibility: visible;
      opacity: 1;
    }
    
    /*--------------------------------------------------------------
    # Real Estate 2 Section
    --------------------------------------------------------------*/
    .real-estate-2 .portfolio-details-slider img {
      width: 100%;
    }
    
    .real-estate-2 .swiper-wrapper {
      height: auto;
    }
    
    .real-estate-2 .swiper-button-prev,
    .real-estate-2 .swiper-button-next {
      width: 48px;
      height: 48px;
    }
    
    .real-estate-2 .swiper-button-prev:after,
    .real-estate-2 .swiper-button-next:after {
      color: rgba(255, 255, 255, 0.8);
      background-color: rgba(0, 0, 0, 0.15);
      font-size: 24px;
      border-radius: 50%;
      width: 48px;
      height: 48px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: 0.3s;
    }
    
    .real-estate-2 .swiper-button-prev:hover:after,
    .real-estate-2 .swiper-button-next:hover:after {
      background-color: rgba(0, 0, 0, 0.3);
    }
    
    @media (max-width: 575px) {
    
      .real-estate-2 .swiper-button-prev,
      .real-estate-2 .swiper-button-next {
        display: none;
      }
    }
    
    .real-estate-2 .swiper-pagination {
      margin-top: 20px;
      position: relative;
    }
    
    .real-estate-2 .swiper-pagination .swiper-pagination-bullet {
      width: 10px;
      height: 10px;
      background-color: color-mix(in srgb, var(--default-color), transparent 85%);
      opacity: 1;
    }
    
    .real-estate-2 .swiper-pagination .swiper-pagination-bullet-active {
      background-color: var(--accent-color);
    }
    
    .real-estate-2 .portfolio-info h3 {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 20px;
      padding-bottom: 20px;
      position: relative;
    }
    
    .real-estate-2 .portfolio-info h3:after {
      content: "";
      position: absolute;
      display: block;
      width: 50px;
      height: 3px;
      background: var(--accent-color);
      left: 0;
      bottom: 0;
    }
    
    .real-estate-2 .portfolio-info ul {
      list-style: none;
      padding: 0;
      font-size: 15px;
    }
    
    .real-estate-2 .portfolio-info ul li {
      display: flex;
      flex-direction: column;
      padding-bottom: 15px;
    }
    
    .real-estate-2 .portfolio-info ul strong {
      text-transform: uppercase;
      font-weight: 400;
      color: color-mix(in srgb, var(--default-color), transparent 50%);
      font-size: 14px;
    }
    
    .real-estate-2 .portfolio-info .btn-visit {
      padding: 8px 40px;
      background: var(--accent-color);
      color: var(--contrast-color);
      border-radius: 50px;
      transition: 0.3s;
    }
    
    .real-estate-2 .portfolio-info .btn-visit:hover {
      background: color-mix(in srgb, var(--accent-color), transparent 20%);
    }
    
    .real-estate-2 .portfolio-description h2 {
      font-size: 26px;
      font-weight: 700;
      margin-bottom: 20px;
    }
    
    .real-estate-2 .portfolio-description p {
      padding: 0;
    }
    
    .real-estate-2 .portfolio-description .testimonial-item {
      padding: 30px 30px 0 30px;
      position: relative;
      background: color-mix(in srgb, var(--default-color), transparent 97%);
      margin-bottom: 50px;
    }
    
    .real-estate-2 .portfolio-description .testimonial-item .testimonial-img {
      width: 90px;
      border-radius: 50px;
      border: 6px solid var(--background-color);
      float: left;
      margin: 0 10px 0 0;
    }
    
    .real-estate-2 .portfolio-description .testimonial-item h3 {
      font-size: 18px;
      font-weight: bold;
      margin: 15px 0 5px 0;
      padding-top: 20px;
    }
    
    .real-estate-2 .portfolio-description .testimonial-item h4 {
      font-size: 14px;
      color: #6c757d;
      margin: 0;
    }
    
    .real-estate-2 .portfolio-description .testimonial-item .quote-icon-left,
    .real-estate-2 .portfolio-description .testimonial-item .quote-icon-right {
      color: color-mix(in srgb, var(--accent-color), transparent 50%);
      font-size: 26px;
      line-height: 0;
    }
    
    .real-estate-2 .portfolio-description .testimonial-item .quote-icon-left {
      display: inline-block;
      left: -5px;
      position: relative;
    }
    
    .real-estate-2 .portfolio-description .testimonial-item .quote-icon-right {
      display: inline-block;
      right: -5px;
      position: relative;
      top: 10px;
      transform: scale(-1, -1);
    }
    
    .real-estate-2 .portfolio-description .testimonial-item p {
      font-style: italic;
      margin: 0 0 15px 0 0 0;
      padding: 0;
    }
    
    .real-estate-2 .nav-pills {
      border-bottom: 1px solid color-mix(in srgb, var(--default-color), transparent 85%);
    }
    
    .real-estate-2 .nav-pills li+li {
      margin-left: 40px;
    }
    
    .real-estate-2 .nav-link {
      background: none;
      font-size: 18px;
      font-weight: 400;
      color: var(--default-color);
      padding: 12px 0;
      margin-bottom: -2px;
      border-radius: 0;
    }
    
    .real-estate-2 .nav-link.active {
      color: var(--accent-color);
      background: none;
      border-bottom: 3px solid var(--accent-color);
    }
    
    @media (max-width: 575px) {
      .real-estate-2 .nav-link {
        font-size: 16px;
      }
    }
    
    .real-estate-2 .tab-content h4 {
      font-size: 18px;
      margin: 0;
      font-weight: 700;
      color: var(--default-color);
    }
    
    .real-estate-2 .tab-content i {
      font-size: 22px;
      line-height: 0;
      margin-right: 8px;
      color: var(--accent-color);
    }
    
    /*--------------------------------------------------------------
    # Starter Section Section
    --------------------------------------------------------------*/
    .starter-section {
      /* Add your styles here */
    }
    img {
        overflow-clip-margin: content-box;
        overflow: clip;
        bottom: 80px;
        width: 750px;
        height: auto;
        max-width: 100%;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        left: 01.5em;
    }
    
    .conteneur-txt {
        position: relative;
        left: 35em;
        bottom: 21.2em;
       right: 20px;
        width: 800px;
        height: auto;
        max-height: 85em;
      padding: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(6.4px);
    -webkit-backdrop-filter: blur(6.4px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    
        
    }
    .conteneur-txt-1 {
        position: relative;
        left: 35em;
        bottom: 21.2em;
       right: 20px;
        width: 800px;
        height: auto;
        max-height: 79em;
      padding: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(6.4px);
    -webkit-backdrop-filter: blur(6.4px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    
        
    }
    .conteneur-txt-2 {
        position: relative;
        left: 35em;
        bottom: 21.2em;
       right: 20px;
        width: 800px;
        height: auto;
        max-height: 55em;
      padding: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(6.4px);
    -webkit-backdrop-filter: blur(6.4px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    
        
    }
    .conteneur-txt-3 {
        position: relative;
        left: 35em;
        bottom: 21.2em;
       right: 20px;
        width: 800px;
        height: auto;
        max-height: 77em;
      padding: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(6.4px);
    -webkit-backdrop-filter: blur(6.4px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    
        
    }
    .conteneur-txt-4   {
        position: relative;
        left: 35em;
        bottom: 21.2em;
       right: 20px;
        width: 800px;
        height: auto;
        max-height: 77em;
      padding: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(6.4px);
    -webkit-backdrop-filter: blur(6.4px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    
        
    }
    #acceuil{
        position: relative;
        right: 10em;
        bottom: 17.5em;
        width: 650px;
        height: auto;
        max-width: 100%;
    }
    .footer {
        color: var(--default-color);
        background-color: var(--background-color);
        font-size: 14px;
        padding: 40px 0 0 0;
        position: relative;
        display: block;
        unicode-bidi: isolate;
    }
    h3{
        color: #ffc107d8;
    }
    a:focus{
        background-color: #2eca6a;
        color: white;
    }
    .service-details .services-list a:focus {
        background-color: #2eca6a;
        color: white;
        transition: all 01s;
    }
    
    .button-77 {
      align-items: center;
      appearance: none;
      background-clip: padding-box;
      background-color: initial;
      background-image: none;
      border-style: none;
      box-sizing: border-box;
      color: #fff;
      cursor: pointer;
      display: inline-block;
      flex-direction: row;
      flex-shrink: 0;
      font-family: Eina01,sans-serif;
      font-size: 16px;
      font-weight: 800;
      justify-content: center;
      line-height: 24px;
      margin: 0;
      min-height: 64px;
      outline: none;
      overflow: visible;
      padding: 19px 26px;
      pointer-events: auto;
      position: relative;
      text-align: center;
      text-decoration: none;
      text-transform: none;
      user-select: none;
      -webkit-user-select: none;
      touch-action: manipulation;
      vertical-align: middle;
      width: auto;
      word-break: keep-all;
      z-index: 0;
      position: relative;
      top: 20px;
    }
    
    @media (min-width: 768px) {
      .button-77 {
        padding: 19px 32px;
      }
    }
    
    .button-77:before,
    .button-77:after {
      border-radius: 80px;
    }
    
    .button-77:before {
      background-color: rgba(249, 58, 19, .32);
      content: "";
      display: block;
      height: 100%;
      left: 0;
      overflow: hidden;
      position: absolute;
      top: 0;
      width: 100%;
      z-index: -2;
    }
    
    .button-77:after {
      background-color: initial;
      background-image: linear-gradient(92.83deg, #ff7426 0, #f93a13 100%);
      bottom: 4px;
      content: "";
      display: block;
      left: 4px;
      overflow: hidden;
      position: absolute;
      right: 4px;
      top: 4px;
      transition: all 100ms ease-out;
      z-index: -1;
    }
    
    .button-77:hover:not(:disabled):after {
      bottom: 0;
      left: 0;
      right: 0;
      top: 0;
      transition-timing-function: ease-in;
    }
    
    .button-77:active:not(:disabled) {
      color: #ccc;
    }
    
    .button-77:active:not(:disabled):after {
        ge: linear-gradient(0deg, rgba(0, 0, 0, .2), rgba(0, 0, 0, .2)), linear-gradient(92.83deg, #ff7426 0, #f93a13 100%);
      bottom: 4px;
      left: 4px;
      right: 4px;
      top: 4px;
    }
    
    .button-77:disabled {
      cursor: default;
      opacity: .24;
    }
    .text{
      position: relative;
      bottom: 250px;
    }
    .haut{
      position: relative;
        
        top: 7px;
        left: 5px;
        
        
        
        width: auto;
        height: 30px;
        
        transition: all 0.4s;
    }
        </style>
       
      <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="row" style="width:100%; justify-content:center">
          @if (Session::get('success1')) <!-- Pour la suppression -->
              <script>
                  Swal.fire({
                      icon: 'success',
                      title: 'Suppression réussie',
                      text: '{{ Session::get('success1') }}',
                      timer: 3000,
                      showConfirmButton: false,
                      background: '#ffcccc', // Couleur de fond personnalisée
                      color: '#b30000' // Texte rouge foncé
                  });
              </script>
          @endif
      
          @if (Session::get('success')) <!-- Pour la modification -->
              <script>
                  Swal.fire({
                      icon: 'success',
                      title: 'Action réussie',
                      text: '{{ Session::get('success') }}',
                      timer: 3000,
                      showConfirmButton: true,
                      background: '#ccffcc', // Couleur de fond personnalisée
                      color: '#006600' // Texte vert foncé
                  });
              </script>
          @endif
      
          @if (Session::get('error')) <!-- Pour une erreur générale -->
              <script>
                  Swal.fire({
                      icon: 'error',
                      title: 'Erreur',
                      text: '{{ Session::get('error') }}',
                      timer: 3000,
                      showConfirmButton: false,
                      background: '#f86750', // Couleur de fond rouge vif
                      color: '#ffffff' // Texte blanc
                  });
              </script>
          @endif
      </div>
      </header>
      
      <main class="main">
    
        <!-- Page Title -->
        <div class="page-title" data-aos="fade">
          <div class="heading">
            <div class="container">
              <div class="row d-flex justify-content-center text-center">
                
              </div>
            </div>
          </div>
          <nav class="breadcrumbs">
            <div class="container">
              <ol>
                <li><a href="{{ route('dashboard') }}" style="color: #2eca6a">Home</a></li>
                <li class="current">Service Administratif</li>
              </ol>
            </div>
            
          </nav>
        </div><!-- End Page Title -->
    
        <!-- Service Details Section -->
        <section id="service-details" class="service-details section">
    
          <div class="container">
    
            <div class="row gy-5">
    
              <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
    
                <div class="service-box">
                  <h4>Service Administratif</h4>
                  <div class="services-list">
                    <a href="#1" id="demamde0"><i class="bi bi-arrow-right-circle"></i><span>Demande d'extrait de naissance (Nouveau né)</span></a>
                    <a href="#2" id="demamde1"><i class="bi bi-arrow-right-circle"></i><span>Demande d'extrait de naissance </span></a>
                    <a href="#3" id="demamde2"><i class="bi bi-arrow-right-circle"></i><span>Demande d'acte de décès</span></a>
                    <a href="#4" id="demamde3"><i class="bi bi-arrow-right-circle"></i><span>Demande d'acte de Mariage</span></a>
                    
                  </div>
                </div><!-- End Services List -->
                <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                <div class="conteneur-txt" data-aos="fade-up" data-aos-delay="200" id="conteneur-txt">
                  <div class="container">
                    <span class="title"></span>
                  </div>
                        <img src="{{ asset('assets/images/profiles/services.png') }}" alt="" class="img-fluid services-img">
                        <div class="text">
                          <strong><h3>Informations à lire avant d'effectuer votre demande </h3></strong>
                          <h1>Où obtenir des documents d'état civil ?</h1>
                          <li>
                              Le service de l'état civil détient les actes concernant des événements survenus sur le territoire de la Ville (sauf les transcriptions de décès).
                          </li>
                          <p>
                              <li>
                                  Le service de l'état civil détient les actes concernant des événements survenus sur le territoire de la Ville (sauf les transcriptions de décès).
                              </li>
                          </p>
                              
                          <p>
                          <h3>Qui peut obtenir des documents d'état civil ?</h3>
                          </p>
                          <p>
                              <li><i class="bi bi-check-circle"></i> <span>Des copies intégrales ou extraits d’actes de naissance ou mariage avec filiation :</span></li>
                          </p>
                          <p><ol><ul>Toute personne majeure ou émancipée, ascendants, descendants, conjoint, partenaire, représentant légal (sont donc exclus les demandes émanant des frère, soeur, oncle, tante, neveu, nièce, concubin, concubine)</ul></ol></p>
                          <p><li><i class="bi bi-check-circle"></i> <span>Sur indication des noms et prénoms des parents de la personne concernée (préciser le nom de jeune fille)</span></li></p>
                          <p><li><i class="bi bi-check-circle"></i> <span>En précisant de la date de l’événement.</span></li></p>
                          
                          <p>
                          <li>Des extraits d’acte de naissance ou de mariage sans filiation et copies d’actes de décès</li>
                          </p>
                          <p>
                          <li>A tout requérant</li>
                          </p>
                          <p><h3>Quelles sont les modalités de délivrance ?</h3></p>
                          <p>La demande peut être effectuée au guichet, par correspondance, par fax ou par l'intermédiaire des formulaires en ligne.</p>
                          <p>Pour toutes demandes, vous devez préciser votre qualité (personne concernée par l'acte, ascendant, descendant, ...) et indiquez la filiation de la personne concernée (les noms et prénoms de ses parents, nom de jeune fille pour les femmes mariées).</p>
                          <p>En l'absence de vérification possible par le service de l'état civil de votre lien de parenté avec la personne concernée par l'acte, votre demande ne pourra pas être traitée.</p>
                          <p>Aussi, nous vous invitons à effectuer celle-ci par courrier en fournissant la preuve de votre lien de parenté par tout document en votre possession (photocopie de livret de famille, actes d'état civil,...) à la
                              Mairie de votre commume
                              Service de l'Etat Civil </p>
                        </div>
                        
                  </div> 
                   
                  </div>
                  <div class="conteneur-txt-1" id="DnewNais" style="display: none;" >
                    <img src="{{ asset('assets/images/profiles/bb.png') }}" alt="">
                    <div class="text">
                      <h3 class="project_title">Déclaration de Naissance</h3>
                                                        
                        <h3 style="color: #000000;">Comment faire la déclaration de naissance </h3>
                        <p> il faut :
                        <ul class="">
                          <li>- Un Certificat de naissance comportant le numéro d’enregistrement, la signature du médecin ou de la sage-femme et le cachet du Centre médical </li></br>
                          <li>- Une pièce d'identité de la mère(Carte nationale d’identité,extrait de naissance , passeport ou certificat de nationalité )  </li></br>
                          <li>- Une pièce d'identité du père(Carte nationale d’identité,extrait de naissance , passeport ou certificat de nationalité )  </li></br>
                          <li>- Une Copie de l'acte de mariage si vous êtes mariéS</li>		
                          
                        </ul>
                        Délai : trois (03) mois à compter du jour de la naissance.
                        </p>													
                      <h3 class="project_title">Acte de Naissance</h3>
                      <p>
                        Un acte de naissance peut donner lieu à la délivrance de 2 documents différents : la copie intégrale, l'extrait simple .</br>
                        La copie intégrale comporte des informations sur la personne concernée par l'acte (nom, prénoms, date et lieu de naissance), des informations sur ses parents et les mentions marginales lorsqu'elles existent.	</br>												
                        Un extrait simple  comporte uniquement les informations sur la personne concernée par l'acte de naissance.
                      </p>
                      <h5 >Comment faire la demande</h5>
                      <p>Pour une demande de copie intégrale ou un extrait simple, il faut présenter sa pièce d'identité et une copie de l'extrait de naissance des frais de timbre (500 F CFA /Copie) sont applicables </p>
    
                              
                              <!-- HTML !-->
                    <!-- HTML !-->
                    <button class="button-77" role="button"><a href="{{ route('naissance.create') }}">Faite Votre demande</a></button>
                    </div>
    
                        
    
    
    
    
    
                            
                  </div>	
    
                  <div class="conteneur-txt-2" id="Dnaissance" style="display: none;" >
                    <img src="{{ asset('assets/images/profiles/bébé.png') }}" alt="">
                    <div class="text">
                      <h3 class="project_title">Demande d'extrait de Naissance</h3>
                                                        
                          <p>
                            <h3 style="color: #000000;">Comment obtenir un extrait de naissance</h3>	
                          </p>
                          <p><h4>Vous souhaitez obtenir un extrait de naissance pour une personne (adulte ou enfant) ? Voici les étapes simples à suivre pour faire votre demande :</h4></p>
    
                          <p>Avant de commencer la procédure, assurez-vous d'avoir les informations suivantes :</p>
                          <p>
                            <li><strong>Numéro de l'acte de naissance </strong>de la personne concernée.</li>
                            <li><strong>Nom et prénoms</strong></li>
                            
                          </p>
                            
    
                            <button class="button-77" role="button"><a href="{{ route('naissanced.create') }}">Faite Votre demande</a></button>
                    </div>
                        
                </div>	
                
                <div class="conteneur-txt-3" id="Ddeces" style="display: none;">
                  <img src="{{ asset('assets/images/profiles/deces.png') }}" alt="">
                  <div class="text">
                    <h3 class="project_title">Déclaration de Décès</h3>
                    <h5>Comment faire la déclaration de naissance</h5>
                        <p> il faut :
                        <ul class="">
                            <li>- Procès-verbal de constations de décès ; </li></br>
                            <li>- Une pièce d'identité du defunt(Carte nationale d’identité,extrait de naissance , passeport ou certificat de nationalité )  </li>
                            <li>- Une pièce d'identité du déclarant(Carte nationale d’identité,extrait de naissance , passeport ou certificat de nationalité )  </li></br>
                            <li>- Copie de l'acte de mariage si le defunt etait marié</li>		
                            <li>- Copie du de-par-la loi s’il y a lieu</li>		
                            
                        </ul>
                        Délai : Quinze (15) jours à compter du jour du décès.
                        </p>																						
                    
                    <h3 class="project_title">Acte de décès</h3>
                    <p>
                        Acte de décès peut donner lieu à la délivrance de 2 documents différents : la copie intégrale, l'extrait simple .</br>
                        La copie intégrale comporte des informations sur la personne concernée par l'acte (nom, prénoms, date et lieu de naissance), des informations sur ses parents et les mentions marginales lorsqu'elles existent.	</br>												
                        Un extrait simple  comporte uniquement les informations sur la personne concernée par l'acte de décès.
                    </p>
                    <h5 >Comment faire la demande</h5>
                    <p>Pour une demande de copie intégrale ou un extrait simple, il faut présenter sa pièce d'identité et une copie de l'extrait de décès des frais de timbre (500 F CFA /Copie) sont applicables </p>
                    <button class="button-77" role="button"><a href="{{ route('deces.create') }}">Faite Votre demande</a></button>
                  </div>
                    
                  </div> 
                
                 <div class="conteneur-txt-4" id="Dmariage" style="display: none;">
                  <div class="text">
                    
                  </div>
      
                  <img src="{{ asset('assets/images/profiles/mariage.png') }}" alt="">
                  <div class="text">
                  
                    <h3 class="project_title">Acte de Mariage</h3>
                    
                            <p>
                              Un acte de mariage peut donner lieu à la délivrance de 2 documents différents : la copie intégrale, l'extrait simple .</br>
                              La copie intégrale comporte des informations sur les époux (noms, prénoms, dates et lieu de naissance), des informations sur leurs parents et les mentions marginales lorsqu'elles existent. 	</br>												
                              Un extrait simple  comporte uniquement les informations  sur les époux. 
                            </p>
                            <h5>Comment faire la demande</h5>
                            <p>Pour une demande de copie intégrale ou un extrait simple, il faut présenter sa pièce d'identité et une copie de l'extrait de mariage.des frais de timbre (500 F CFA /Copie) sont applicables </p>
                            
                            <h3 class="project_title">Mariage Civil</h3>
                            <h5>Les formalités de mariage</h5>
                            <p>Le mariage doit être célébré à la mairie. Toutefois, des exceptions sont prévues. En effet, en cas d'empêchement grave, le procureur de la République pourra demander à l'officier d'état civil de se déplacer au domicile ou à la résidence de l'une des parties pour célébrer le mariage. 
                            </p>
                            <h5>Le nombre de témoins pour la célébration du mariage</h5>
                            <p>
                            La célébration du mariage doit être faite par un officier de l'état civil, à la mairie, en présence de deux témoins.
                            </p>
                            <h5>Constituer son dossier de mariage</h5>
                            <p>Il faut vous rendre au Service Mariage de la Mairie de Cocody pour obtenir les documents à fournir 
                             et faire la réservation de la date du mariage 
                            </p>
                            <button class="button-77" role="button"><a href="{{ route('mariage.create') }}">Faite Votre demande</a></button>
                  </div>
                    
                 </div>
            </div>
            <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center active"><img src="{{ asset('assets/images/profiles/haut.png') }}" alt="" class="haut"></a>
            
            <script>
          document.addEventListener('DOMContentLoaded', () => {
        const idParDefaut = 'conteneur-txt'; // ID du conteneur par défaut
        const boutons = [
            { boutonId: 'demamde0', contenuId: 'DnewNais' },
            { boutonId: 'demamde1', contenuId: 'Dnaissance' },
            { boutonId: 'demamde2', contenuId: 'Ddeces' },
            { boutonId: 'demamde3', contenuId: 'Dmariage' },
        ];
    
        // Fonction pour masquer tout le contenu
        function masquerToutContenu() {
            boutons.forEach(({ contenuId }) => {
                const contenu = document.getElementById(contenuId);
                if (contenu) contenu.style.display = 'none';  // Masque le contenu
            });
            const conteneurParDefaut = document.getElementById(idParDefaut);
            if (conteneurParDefaut) conteneurParDefaut.style.display = 'none'; // Masque le conteneur par défaut
        }
    
        // Fonction pour afficher un contenu spécifique
        function afficherContenu(contenuId) {
            masquerToutContenu();
            const contenu = document.getElementById(contenuId);
            if (contenu) contenu.style.display = 'block';  // Affiche le contenu sélectionné
        }
    
        // Ajouter l'événement de clic à chaque bouton pour afficher le contenu
        boutons.forEach(({ boutonId, contenuId }) => {
            const bouton = document.getElementById(boutonId);
            if (bouton) {
                bouton.addEventListener('click', (event) => {
                    event.preventDefault();  // Empêche le comportement par défaut du lien
                    afficherContenu(contenuId); // Affiche le contenu associé
                });
            }
        });
    
        // Affiche le conteneur par défaut au chargement de la page
        afficherContenu(idParDefaut);
    });

            document.addEventListener("DOMContentLoaded", function() {
        @if (Session::get('success'))
            showMessage('{{ Session::get('success') }}', 'lightgreen');
        @endif
        @if (Session::get('success1'))
            showMessage('{{ Session::get('success1') }}', 'lightred');
        @endif

        @if (Session::get('error'))
            showMessage('{{ Session::get('error') }}', '#f86750');
        @endif
    });

    function showMessage(message, backgroundColor) {
        const popup = document.getElementById('popup-message');
        popup.textContent = message;
        popup.style.backgroundColor = backgroundColor;
        popup.style.display = 'block';

        setTimeout(() => {
            popup.style.display = 'none';
        }, 3000); // Masquer après 3 secondes
    }

    
    
    
            </script>
                   </body> 
    
   
</x-app-layout>
