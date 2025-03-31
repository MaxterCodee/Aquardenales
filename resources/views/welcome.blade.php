<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Water - Monitoreo Inteligente de Calidad y Consumo de Agua</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3498db;
            --secondary: #2ecc71;
            --dark: #2c3e50;
            --light: #ecf0f1;
            --accent: #e74c3c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 100%;
            z-index: 100;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 0;
        }

        .logo {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
        }

        .logo span {
            color: var(--secondary);
        }

        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        .cta-button {
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            background-color: #2980b9;
            color: white;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 150px 0 100px;
            text-align: center;
        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
            color: var(--dark);
        }

        .hero p {
            font-size: 20px;
            max-width: 700px;
            margin: 0 auto 40px;
            color: #555;
        }

        .hero-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .primary-button {
            background-color: var(--primary);
            color: white;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .primary-button:hover {
            background-color: #2980b9;
        }

        .secondary-button {
            background-color: white;
            color: var(--primary);
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 600;
            text-decoration: none;
            border: 2px solid var(--primary);
            transition: all 0.3s;
        }

        .secondary-button:hover {
            background-color: var(--primary);
            color: white;
        }

        /* Features Section */
        .features {
            padding: 100px 0;
            background-color: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 36px;
            color: var(--dark);
            margin-bottom: 15px;
        }

        .section-title p {
            color: #777;
            max-width: 700px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background-color: var(--light);
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            background-color: var(--primary);
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .feature-icon i {
            color: white;
            font-size: 36px;
        }

        .feature-card h3 {
            font-size: 22px;
            margin-bottom: 15px;
            color: var(--dark);
        }

        /* How It Works */
        .how-it-works {
            padding: 100px 0;
            background-color: #f9f9f9;
        }

        .steps {
            display: flex;
            flex-direction: column;
            gap: 40px;
            max-width: 800px;
            margin: 0 auto;
        }

        .step {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .step-number {
            background-color: var(--primary);
            color: white;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .step-content h3 {
            font-size: 22px;
            margin-bottom: 10px;
            color: var(--dark);
        }

        /* Technology */
        .technology {
            padding: 100px 0;
            background-color: white;
        }

        .tech-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .tech-card {
            background-color: var(--light);
            border-radius: 10px;
            padding: 30px;
            text-align: center;
        }

        .tech-card img {
            height: 80px;
            margin-bottom: 20px;
        }

        /* Testimonials */
        .testimonials {
            padding: 100px 0;
            background-color: #f9f9f9;
        }

        .testimonial-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .testimonial-card {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .testimonial-text {
            font-style: italic;
            margin-bottom: 20px;
            color: #555;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .author-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--light);
        }

        .author-info h4 {
            font-weight: 600;
            color: var(--dark);
        }

        .author-info p {
            color: #777;
            font-size: 14px;
        }

        /* CTA Section */
        .cta-section {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .cta-section p {
            max-width: 700px;
            margin: 0 auto 40px;
            font-size: 18px;
            opacity: 0.9;
        }

        /* Footer */
        footer {
            background-color: var(--dark);
            color: white;
            padding: 60px 0 20px;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-logo {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .footer-links h3 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 10px;
        }

        .footer-links a {
            color: #bbb;
            text-decoration: none;
            transition: color 0.3s;
        }

        .footer-links a:hover {
            color: white;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }

        .social-links a:hover {
            background-color: var(--primary);
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: #bbb;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 36px;
            }

            .hero p {
                font-size: 18px;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .nav-links {
                display: none;
            }

            .step {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav>
                <div class="logo">Verify<span>Water</span></div>
                <div class="nav-links">
                    <a href="#features">Características</a>
                    <a href="#how-it-works">Cómo funciona</a>
                    <a href="#technology">Tecnología</a>
                    <a href="#testimonials">Testimonios</a>
                    <a href="#contact">Contacto</a>
                </div>

                @if (Auth::check())
                    <!-- Si el usuario está logueado, mostrar el botón de "Inicio" -->
                    <a href="{{ route('dashboard') }}" class="cta-button">Inicio</a>
                @else
                    <!-- Si el usuario no está logueado, mostrar los botones de login y registro -->
                    <a href="{{ route('login') }}" class="cta-button">Iniciar sesión</a>
                    <a href="{{ route('register') }}" class="cta-button">Registrarse</a>
                @endif
            </nav>
        </div>
    </header>


    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Monitoreo inteligente de calidad y consumo de agua</h1>
            <p>Verify Water utiliza sensores IoT y tecnología avanzada para ayudarte a gestionar mejor este recurso
                vital en tu hogar o negocio.</p>
            <div class="hero-buttons">
                <a href="#cta" class="primary-button">Comenzar ahora</a>
                <a href="#how-it-works" class="secondary-button">Ver demostración</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-title">
                <h2>Control total sobre tu agua</h2>
                <p>Nuestro sistema te proporciona información en tiempo real para tomar decisiones informadas sobre el
                    consumo de agua.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-tint"></i>
                    </div>
                    <h3>Calidad del agua</h3>
                    <p>Monitoreo continuo de pH, turbiedad, presión y otros parámetros críticos para garantizar agua
                        segura.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Consumo inteligente</h3>
                    <p>Visualiza y analiza tus patrones de consumo para identificar oportunidades de ahorro.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3>Alertas inmediatas</h3>
                    <p>Recibe notificaciones sobre fugas, cambios en la calidad del agua o consumo inusual.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="how-it-works" id="how-it-works">
        <div class="container">
            <div class="section-title">
                <h2>Cómo funciona Verify Water</h2>
                <p>Una solución sencilla pero poderosa para la gestión del agua en tu hogar o negocio.</p>
            </div>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Instalación sencilla</h3>
                        <p>Nuestros sensores IoT se instalan fácilmente en tu tinaco sin necesidad de
                            obras complejas.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Recolección de datos</h3>
                        <p>Los sensores capturan información sobre calidad y consumo de agua las 24 horas del día.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Análisis inteligente</h3>
                        <p>Nuestra plataforma procesa los datos con IA para identificar patrones y anomalías.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Información accionable</h3>
                        <p>Recibe informes detallados y recomendaciones personalizadas para optimizar tu consumo.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tecnología -->
    <section class="technology" id="technology">
        <div class="container">
            <div class="section-title">
                <h2>Innovación a tu servicio</h2>
                <p>Utilizamos herramientas avanzadas para brindarte información clara y confiable.</p>
            </div>
            <div class="tech-grid">
                <div class="tech-card">
                    <img src="https://cdn-icons-png.freepik.com/512/9708/9708985.png" alt="IoT">
                    <h3>Sensores inteligentes</h3>
                    <p>Dispositivos que miden en tiempo real para ofrecerte datos precisos.</p>
                </div>
                <div class="tech-card">
                    <img src="https://cdn-icons-png.flaticon.com/512/2103/2103633.png" alt="IA">
                    <h3>Predicción inteligente</h3>
                    <p>Analizamos la información para anticiparnos a posibles problemas.</p>
                </div>
                <div class="tech-card">
                    <img src="https://cdn-icons-png.flaticon.com/512/4727/4727515.png" alt="Docker">
                    <h3>Sistema estable</h3>
                    <p>Garantizamos que todo funcione sin interrupciones, sin que tengas que preocuparte.</p>
                </div>
                <div class="tech-card">
                    <img src="https://cdn-icons-png.freepik.com/512/10397/10397311.png" alt="Gemini">
                    <h3>Análisis avanzado</h3>
                    <p>Transformamos datos en información útil para facilitar la toma de decisiones.</p>
                </div>
            </div>
        </div>
    </section>


    <!-- Testimonials -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>Lo que dicen nuestros usuarios</h2>
                <p>Descubre cómo Verify Water está transformando la gestión del agua en hogares y negocios.</p>
            </div>
            <div class="testimonial-grid">
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "Verify Water nos ayudó a detectar una fuga que no sabíamos que teníamos. En un mes recuperamos
                        la inversión con el ahorro en la factura."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar"></div>
                        <div class="author-info">
                            <h4>Ana Martínez</h4>
                            <p>Usuario residencial</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "Como pequeño negocio, el control del consumo de agua es crucial. Verify Water nos da la
                        información que necesitamos para optimizar nuestros procesos."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar"></div>
                        <div class="author-info">
                            <h4>Carlos Rodríguez</h4>
                            <p>Dueño de cafetería</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="testimonial-text">
                        "La tranquilidad de saber que el agua que consume mi familia cumple con los estándares de
                        calidad no tiene precio. La plataforma es muy fácil de usar."
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar"></div>
                        <div class="author-info">
                            <h4>Laura González</h4>
                            <p>Madre de familia</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" id="cta">
        <div class="container">
            <h2>¿Listo para tomar el control de tu agua?</h2>
            <p>Únete a la revolución de la gestión inteligente del agua y comienza a ahorrar mientras contribuyes a un
                futuro más sostenible.</p>
            <a href="#" class="primary-button">Contratar ahora Verify Water</a>
        </div>
    </section>

    <!-- Footer -->
    <footer id="contact">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-about">
                    <div class="footer-logo">Verify<span>Water</span></div>
                    <p>Soluciones innovadoras para el monitoreo y gestión inteligente del agua en hogares y negocios.
                    </p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h3>Producto</h3>
                    <ul>
                        <li><a href="#features">Características</a></li>
                        <li><a href="#how-it-works">Cómo funciona</a></li>
                        <li><a href="#technology">Tecnología</a></li>
                        <li><a href="#pricing">Precios</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Empresa</h3>
                    <ul>
                        <li><a href="#">Sobre nosotros</a></li>
                        <li><a href="#">Equipo</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Carreras</a></li>
                    </ul>
                </div>
                <div class="footer-links">
                    <h3>Contacto</h3>
                    <ul>
                        <li><a href="mailto:info@verifywater.com">info@verifywater.com</a></li>
                        <li><a href="tel:+525512345678">+52 55 1234 5678</a></li>
                        <li><a href="#">Soporte</a></li>
                        <li><a href="#">Preguntas frecuentes</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; 2025 Verify Water. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</body>

</html>
