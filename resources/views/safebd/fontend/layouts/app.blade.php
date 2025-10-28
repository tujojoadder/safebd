<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'সেফ বাংলাদেশ ফাউন্ডেশন - রক্তদান সেবা')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;600;700&display=swap" rel="stylesheet" />
    
    <style>
        :root {
            --primary-green: #10b981;
            --dark-green: #047857;
            --light-green: #34d399;
            --accent-orange: #f59e0b;
            --dark: #1f2937;
            --light: #f9fafb;
            --blood-red: #ef4444;
        }
         @font-face {
            font-family: 'SolaimanLipi';
            src: url('{{ asset('fonts/SolaimanLipi.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body, h1, h2, h3, h4, h5, h6, p, span, div, a {
            font-family: 'SolaimanLipi', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
          
            color: var(--dark);
            overflow-x: hidden;
            background: var(--light);
        }

        /* Top Header with Glassmorphism */
        .top-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 10px 0;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid rgba(16, 185, 129, 0.1);
        }

        

        .logo-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-green), var(--light-green));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
            transition: transform 0.3s ease;
        }

        .logo-icon:hover {
            transform: rotate(5deg) scale(1.05);
        }

        .logo-icon i {
            font-size: 35px;
            color: white;
        }

        .org-info h1 {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 5px;
        }

        .org-info p {
            font-size: 0.95rem;
            color: #6b7280;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 15px;
            justify-content: flex-end;
        }

        .social-links {
            display: flex;
            gap: 8px;
        }

        .social-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }

        .social-icon:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .social-icon.facebook { background: linear-gradient(135deg, #1877f2, #0c63d4); }
        .social-icon.twitter { background: linear-gradient(135deg, #1da1f2, #0d8bd9); }
        .social-icon.linkedin { background: linear-gradient(135deg, #0077b5, #005582); }
        .social-icon.youtube { background: linear-gradient(135deg, #ff0000, #cc0000); }

        .reg-badge {
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .btn-register {
            background: linear-gradient(135deg, var(--accent-orange), #ea580c);
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 5px 20px rgba(245, 158, 11, 0.3);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(245, 158, 11, 0.4);
            color: white;
        }

        /* Navigation */
        .main-nav {
            background: linear-gradient(135deg, var(--primary-green), var(--dark-green));
            padding: 0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            padding: 18px 20px !important;
            font-weight: 500;
            font-size: 1rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white !important;
        }

        .nav-link i {
            margin-right: 6px;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, #1f2937, #111827);
            color: white;
            padding: 60px 0 30px;
        }

        .footer-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 25px;
            color: var(--accent-orange);
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a {
            color: #d1d5db;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .footer-links a:hover {
            color: var(--accent-orange);
            padding-left: 5px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 40px;
            padding-top: 25px;
            text-align: center;
            color: #9ca3af;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-actions {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
            .org-info h1 {
                font-size: 1.5rem;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body>
   @include('safebd.fontend.partials.header')

    @yield('content')

    @include('safebd.fontend.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

      <!-- jQuery & jQuery UI CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-datepicker/1.13.2/i18n/datepicker-bn.js"></script>
    <script>
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener("click", function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute("href"));
                if (target) {
                    target.scrollIntoView({ behavior: "smooth", block: "start" });
                }
            });
        });

        // Add active nav on scroll
        window.addEventListener("scroll", () => {
            const topHeader = document.querySelector(".top-header");
            if (topHeader) {
                if (window.scrollY > 100) {
                    topHeader.style.boxShadow = "0 8px 30px rgba(0,0,0,0.1)";
                } else {
                    topHeader.style.boxShadow = "0 4px 30px rgba(0,0,0,0.05)";
                }
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>