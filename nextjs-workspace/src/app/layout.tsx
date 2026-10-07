import type { Metadata } from "next";
import "./globals.css";
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import WhatsAppWidget from "@/components/WhatsAppWidget";

export const metadata: Metadata = {
  title: {
    default: "Wahana Totalita Konsultan — Pelatihan K3 & Sertifikasi Resmi",
    template: "%s | Wahana Totalita Konsultan",
  },
  description:
    "Wahana Totalita Konsultan menyediakan pelatihan K3, Lingkungan, Mining & ISO terakreditasi resmi KEMNAKER RI dan BNSP. Online & offline. Berbasis di Yogyakarta.",
  keywords: [
    "Pelatihan K3",
    "Ahli K3 Umum",
    "Kemnaker RI",
    "BNSP",
    "CSMS",
    "SMK3",
    "Sertifikasi K3",
    "Yogyakarta",
  ],
};

export default function RootLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="id">
      <body className="flex flex-col min-h-screen">
        <Navbar />
        <main className="flex-grow">{children}</main>
        <Footer />
        <WhatsAppWidget />
      </body>
    </html>
  );
}
