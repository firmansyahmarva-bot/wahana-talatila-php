import React from "react";
import type { Metadata, Viewport } from "next";

export const viewport: Viewport = {
  width: "device-width",
  initialScale: 1,
  maximumScale: 5,
};

export const metadata: Metadata = {
  metadataBase: new URL("https://wahanatotalita.com"),
  robots: {
    index: true,
    follow: true,
  },
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="id" suppressHydrationWarning>
      <head>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin="anonymous" />
        <script
          dangerouslySetInnerHTML={{
            __html: `
              // Global interaction handler for hamburger, dropdowns, and FAQ accordions
              document.addEventListener('click', function(e) {
                // FAQ item toggle
                var faqBtn = e.target.closest('.faq-question');
                if (faqBtn) {
                  var item = faqBtn.closest('.faq-item');
                  if (item) item.classList.toggle('open');
                }

                // Mobile hamburger toggle
                var hamburger = e.target.closest('#nav-hamburger, .nav-hamburger');
                if (hamburger) {
                  var links = document.getElementById('nav-links') || document.querySelector('.nav-links');
                  if (links) {
                    var isOpen = links.classList.contains('open');
                    links.classList.toggle('open', !isOpen);
                    hamburger.setAttribute('aria-expanded', !isOpen);
                  }
                }
              });
            `,
          }}
        />
      </head>
      <body suppressHydrationWarning style={{ margin: 0, padding: 0 }}>
        {children}
      </body>
    </html>
  );
}
