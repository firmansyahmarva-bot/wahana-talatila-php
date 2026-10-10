import React from 'react';
import type { Metadata, Viewport } from 'next';
import Navbar from '@/components/layout/Navbar';
import Footer from '@/components/layout/Footer';
import PhotoStrip from '@/components/layout/PhotoStrip';
import MobileBottomNav from '@/components/layout/MobileBottomNav';
import WhatsAppFloat from '@/components/layout/WhatsAppFloat';
import ScrollProgress from '@/components/layout/ScrollProgress';
import SkipLink from '@/components/layout/SkipLink';
import ContentInteractions from '@/components/common/ContentInteractions';
import './globals.css';

export const viewport: Viewport = {
  width: 'device-width',
  initialScale: 1,
  maximumScale: 5,
};

export const metadata: Metadata = {
  metadataBase: new URL('https://wahanatotalita.com'),
  robots: {
    index: true,
    follow: true,
  },
  icons: {
    icon: '/favicon.ico',
    apple: '/apple-touch-icon.png',
  },
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="id">
      <head>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossOrigin="anonymous" />
        <link
          rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap"
        />
        <link rel="stylesheet" href="/assets/css/tokens.css" />
        <link rel="stylesheet" href="/assets/css/core.min.css" />
        <link rel="stylesheet" href="/assets/css/components.min.css" />
        <link rel="stylesheet" href="/assets/css/site.css" />
      </head>
      <body style={{ margin: 0, padding: 0 }}>
        <ScrollProgress />
        <SkipLink />
        <Navbar />
        {children}
        <PhotoStrip />
        <Footer />
        <MobileBottomNav />
        <WhatsAppFloat />
        <ContentInteractions />
      </body>
    </html>
  );
}
