import type { NextConfig } from "next";

const isProd = process.env.NODE_ENV === 'production';
const isGitHubPages = process.env.GITHUB_PAGES === 'true';

const nextConfig: NextConfig = {
  output: 'export',
  trailingSlash: true,
  images: {
    unoptimized: true
  },
  basePath: isGitHubPages ? '/ProtectChildrenAustralia' : '',
  assetPrefix: isGitHubPages ? '/ProtectChildrenAustralia' : '',
};

export default nextConfig;
