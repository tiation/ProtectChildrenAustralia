import type { Metadata } from "next";
import { Geist, Geist_Mono } from "next/font/google";
import { Header } from "../components/Header";
import "./globals.css";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export const metadata: Metadata = {
  title: "Protect Children Australia",
  description: "Empowering communities to protect children in Australia",
  keywords: ["child protection", "Australia", "community safety", "child welfare"],
  authors: [{ name: "Protect Children Australia" }],
  creator: "Protect Children Australia",
  publisher: "Protect Children Australia"
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="en" className="light">
      <body
        className={`${geistSans.variable} ${geistMono.variable} antialiased bg-white dark:bg-gray-950 transition-colors duration-300`}
      >
        <div className="min-h-screen bg-gradient-to-br from-white to-gray-100 dark:from-gray-950 dark:to-gray-900">
          <Header />
          <main className="pt-20">
            {children}
          </main>
        </div>
      </body>
    </html>
  );
}
