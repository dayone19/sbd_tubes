<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Discogs Footer</title>
  <style>
    .footer *, .footer *::before, .footer *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    .footer .body {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }

    /* hanya footer yang gelap */
    .footer {
        background-color: #121212;
        color: #ffffff;
        padding: 48px 40px 32px;
    }

    .footer-top {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr 1.4fr;
      gap: 40px;
      border-bottom: none;
      padding-bottom: 40px;
    }

    /* Columns */
    .footer-col h4 {
      font-size: 15px;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 20px;
      letter-spacing: 0.01em;
    }

    .footer-col ul {
      list-style: none;
    }

    .footer-col ul li {
      margin-bottom: 14px;
    }

    .footer-col ul li a {
      color: #9e9e9e;
      text-decoration: none;
      font-size: 14px;
      transition: color 0.2s ease;
    }

    .footer-col ul li a:hover {
      color: #ffffff;
    }

    /* Right column – newsletter + social */
    .footer-right {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    /* Social icons */
    .social-icons {
      display: flex;
      gap: 50px;
      align-items: center;
    }

    .social-icons a {
      color: #ffffff;
      text-decoration: none;
      font-size: 22px;
      line-height: 1;
      transition: opacity 0.2s;
    }

    .social-icons a:hover {
      opacity: 0.7;
    }

    /* SVG icons inline */
    .social-icons svg {
      width: 22px;
      height: 22px;
      fill: #ffffff;
      display: block;
    }

    /* Newsletter */
    .newsletter p {
      font-size: 13px;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 12px;
    }

    .newsletter-form {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .newsletter-form input[type="email"] {
      background-color: #ffffff;
      border: none;
      border-radius: 4px;
      padding: 11px 14px;
      font-size: 13px;
      color: #333333;
      outline: none;
      width: 100%;
    }

    .newsletter-form input[type="email"]::placeholder {
      color: #888888;
    }

    .newsletter-form button {
      background-color: #000000;
      color: #ffffff;
      border: 2px solid #ffffff;
      border-radius: 999px;
      padding: 11px 0;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
      width: 100%;
      letter-spacing: 0.02em;
      transition: background 0.2s, color 0.2s;
    }

    .newsletter-form button:hover {
      background-color: #ffffff;
      color: #000000;
    }

    .newsletter-disclaimer {
      font-size: 11px;
      color: #777777;
      line-height: 1.5;
    }

    .newsletter-disclaimer a {
      color: #777777;
      text-decoration: underline;
    }

    /* App store buttons */
    .app-buttons {
      display: flex;
      gap: 10px;
    }

    .app-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      background-color: #000000;
      border: 1.5px solid #ffffff;
      border-radius: 8px;
      padding: 8px 14px;
      text-decoration: none;
      color: #ffffff;
      flex: 1;
      transition: background 0.2s, color 0.2s;
    }

    .app-btn:hover {
      background-color: #ffffff;
      color: #000000;
    }

    .app-btn:hover svg {
      fill: #000000;
    }

    .app-btn svg {
      width: 22px;
      height: 22px;
      fill: #ffffff;
      flex-shrink: 0;
      transition: fill 0.2s;
    }

    .app-btn-text {
      display: flex;
      flex-direction: column;
      line-height: 1.2;
    }

    .app-btn-text span:first-child {
      font-size: 9px;
      font-weight: 400;
      letter-spacing: 0.04em;
      text-transform: uppercase;
    }

    .app-btn-text span:last-child {
      font-size: 13px;
      font-weight: 700;
    }

    /* Language selector */
    .lang-select {
      width: 100%;
      background-color: #1e1e1e;
      border: 1.5px solid #3a3a3a;
      border-radius: 6px;
      color: #ffffff;
      padding: 12px 14px;
      font-size: 14px;
      cursor: pointer;
      appearance: none;
      -webkit-appearance: none;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath fill='%23ffffff' d='M1 1l5 5 5-5'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 14px center;
    }

    .lang-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .lang-wrapper .globe-icon {
      position: absolute;
      left: 14px;
      width: 16px;
      height: 16px;
      fill: #ffffff;
      pointer-events: none;
    }

    .lang-select {
      padding-left: 38px;
    }

    /* ── BOTTOM BAR ── */
    .footer .footer-bottom {
      margin-top: 28px;
      display: flex;
      align-items: center;
      flex-wrap: nowrap; 
      gap: 16px;
      font-size: 12px;
      color: #666666;
      white-space: nowrap;
      overflow-x: auto;
    }

    .footer .footer-bottom a {
      color: #666666;
      text-decoration: none;
      transition: color 0.2s;
    }

    .footer .footer-bottom a:hover {
      color: #ffffff;
    }

    .footer .footer-bottom .copyright {
      color: #666666;
      display: inline-flex;
      align-items: center;
      gap: 0;
      flex-shrink: 0;
    }

    .footer .footer-bottom .cookie-settings {
      display: flex;
      align-items: center;
      gap: 5px;
      cursor: pointer;
      color: #666666;
      transition: color 0.2s;
    }

    .footer .footer-bottom .cookie-settings:hover {
      color: #ffffff;
    }

    .footer .footer-bottom .cookie-settings svg {
      width: 14px;
      height: 14px;
      fill: #666666;
    }

    .divider {
      color: #3a3a3a;
    }
  </style>
</head>
<body>

<footer class="footer">
  <div class="footer-top">

    <!-- About -->
    <div class="footer-col">
      <h4>About</h4>
      <ul>
        <li><a href="#">Get Started</a></li>
        <li><a href="#">What is Discogs?</a></li>
        <li><a href="#">Discography</a></li>
        <li><a href="#">Marketplace</a></li>
        <li><a href="#">Collection</a></li>
        <li><a href="#">Wantlist</a></li>
        <li><a href="#">Statistics</a></li>
        <li><a href="#">Careers</a></li>
      </ul>
    </div>

    <!-- Community -->
    <div class="footer-col">
      <h4>Community</h4>
      <ul>
        <li><a href="#">Community Guidelines</a></li>
        <li><a href="#">Community Advisory</a></li>
        <li><a href="#">Contributor List</a></li>
        <li><a href="#">Add Release</a></li>
        <li><a href="#">Developer API</a></li>
        <li><a href="#">Help Translate</a></li>
      </ul>
    </div>

    <!-- Help & Resources -->
    <div class="footer-col">
      <h4>Help &amp; Resources</h4>
      <ul>
        <li><a href="#">Help Center</a></li>
        <li><a href="#">Seller Resource Center</a></li>
        <li><a href="#">Submission Guidelines</a></li>
        <li><a href="#">Trust Center</a></li>
        <li><a href="#">Forum</a></li>
        <li><a href="#">System Status</a></li>
        <li><a href="#">Keyboard Shortcuts</a></li>
      </ul>
    </div>

    <!-- Right: Social + Newsletter + Apps + Language -->
    <div class="footer-right">

      <!-- Social Icons -->
      <div class="social-icons">
        <!-- Facebook -->
        <a href="#" aria-label="Facebook">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987H7.898V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
          </svg>
        </a>
        <!-- Instagram -->
        <a href="#" aria-label="Instagram">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
          </svg>
        </a>
        <!-- YouTube -->
        <a href="#" aria-label="YouTube">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
          </svg>
        </a>
        <!-- TikTok -->
        <a href="#" aria-label="TikTok">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
          </svg>
        </a>
        <!-- LinkedIn -->
        <a href="#" aria-label="LinkedIn">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
          </svg>
        </a>
        <!-- X (Twitter) -->
        <a href="#" aria-label="X">
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.253 5.622 5.91-5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
          </svg>
        </a>
      </div>

      <!-- Newsletter -->
      <div class="newsletter">
        <p>Find music, track trends &amp; stay updated.</p>
        <div class="newsletter-form">
          <input type="email" placeholder="Enter email address" />
          <button type="button">Sign Up</button>
        </div>
        <p class="newsletter-disclaimer" style="margin-top:10px; font-size:10px; font-weight:400">
          By entering my email address, I consent to receive communications about music, promotions, and Discogs. Unsubscribe at any time using the "unsubscribe" link in the emails. Learn more about your rights and how Discogs handles your personal data by reviewing the <a href="#" style="color:white"><u>Privacy Policy.</u></a>
        </p>
      </div>

      <!-- App Buttons -->
      <div class="app-buttons">
        <a href="#" class="app-btn">
          <!-- Apple logo -->
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.8-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
          </svg>
          <div class="app-btn-text">
            <span>Download on the</span>
            <span>App Store</span>
          </div>
        </a>
        <a href="#" class="app-btn">
          <!-- Google Play logo -->
          <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M3.18 23.76c.3.16.64.22.99.16l12.87-7.43-2.63-2.63-11.23 9.9zM.68 1.5C.26 1.93 0 2.6 0 3.47v17.06c0 .87.26 1.54.68 1.97l.1.1 9.56-9.56v-.22L.78 1.4l-.1.1zM20.13 10.3l-2.73-1.58-2.94 2.94 2.94 2.94 2.76-1.59c.79-.45.79-1.19-.03-1.71zM3.18.24L16.05 7.67l-2.63 2.63L2.18.4c.3-.17.66-.22 1 .16-.01 0 0 .08 0 .08z"/>
          </svg>
          <div class="app-btn-text">
            <span>GET IT ON</span>
            <span>Google Play</span>
          </div>
        </a>
      </div>

      <!-- Language Selector -->
      <div class="lang-wrapper">
        <svg class="globe-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
        </svg>
        <select class="lang-select">
          <option>English</option>
          <option>Bahasa Indonesia</option>
          <option>Deutsch</option>
          <option>Español</option>
          <option>Français</option>
          <option>Italiano</option>
          <option>日本語</option>
          <option>한국어</option>
          <option>Português</option>
        </select>
      </div>

    </div>
  </div>

  <!-- Bottom Bar -->
  <div class="footer-bottom">
    <span class="copyright">© 2026 Discogs®</span>
    <span class="cookie-settings">
      <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path d="M21.598 11.064a1.006 1.006 0 0 0-.854-.172A2.938 2.938 0 0 1 20 11c-1.654 0-3-1.346-3.003-2.937.005-.034.016-.136.017-.17a1 1 0 0 0-1.224-1.01A2.99 2.99 0 0 1 15 7c-1.654 0-3-1.346-3-3 0-.104.012-.208.028-.311a1 1 0 0 0-1.17-1.146A10.017 10.017 0 0 0 2 12c0 5.514 4.486 10 10 10s10-4.486 10-10c0-.23-.023-.455-.046-.68a1.003 1.003 0 0 0-.356-.256zM12 20c-4.411 0-8-3.589-8-8a8.006 8.006 0 0 1 6.852-7.918A5 5 0 0 0 16 8.01C16 8.019 16 8.009 16 8c0-.003.002-.006.002-.009a5.006 5.006 0 0 0 4.792-3.562C20.928 4.873 21 5.435 21 6c0 4.411-3.589 8-9 8z"/>
        <circle cx="9" cy="13" r="1.5"/>
        <circle cx="13" cy="17" r="1.5"/>
        <circle cx="14" cy="10" r="1.5"/>
      </svg>
      Cookie Settings
    </span>
    <span class="divider"></span>
    <a href="#">Cookie Policy</a>
    <span class="divider"></span>
    <a href="#">Terms of Service</a>
    <span class="divider"></span>
    <a href="#">Privacy Policy</a>
    <span class="divider"></span>
    <a href="#">California Privacy Notice</a>
    <span class="divider"></span>
    <a href="#">Accessibility Statement</a>
    <span class="divider"></span>
    <a href="#">Impressum</a>
  </div>
</footer>

</body>
</html>