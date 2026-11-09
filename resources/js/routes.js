/**
 * Lightweight Route Helper for Nirwana Admin Vue SPA
 */
const routes = {
  // Dashboard & Auth
  'admin.dashboard': () => '/admin',
  'admin.login': () => '/admin/login',
  'admin.logout': () => '/admin/logout',

  // Paket Wisata
  'admin.packages.index': () => '/admin/packages',
  'admin.packages.create': () => '/admin/packages/create',
  'admin.packages.store': () => '/admin/packages',
  'admin.packages.edit': (id) => `/admin/packages/${id}/edit`,
  'admin.packages.update': (id) => `/admin/packages/${id}`,
  'admin.packages.destroy': (id) => `/admin/packages/${id}`,
  'admin.packages.toggle': (id) => `/admin/packages/${id}/toggle`,
  'admin.packages.bulk-delete': () => '/admin/packages/bulk-delete',

  // Layanan Perjalanan
  'admin.services.index': () => '/admin/services',
  'admin.services.create': () => '/admin/services/create',
  'admin.services.store': () => '/admin/services',
  'admin.services.edit': (id) => `/admin/services/${id}/edit`,
  'admin.services.update': (id) => `/admin/services/${id}`,
  'admin.services.destroy': (id) => `/admin/services/${id}`,
  'admin.services.toggle': (id) => `/admin/services/${id}/toggle`,

  // Artikel & Berita
  'admin.posts.index': () => '/admin/posts',
  'admin.posts.create': () => '/admin/posts/create',
  'admin.posts.generator': () => '/admin/posts/generator',
  'admin.posts.generate': () => '/admin/posts/generator',
  'admin.posts.store': () => '/admin/posts',
  'admin.posts.edit': (id) => `/admin/posts/${id}/edit`,
  'admin.posts.update': (id) => `/admin/posts/${id}`,
  'admin.posts.destroy': (id) => `/admin/posts/${id}`,
  'admin.posts.toggle': (id) => `/admin/posts/${id}/toggle`,
  'admin.posts.bulk-delete': () => '/admin/posts/bulk-delete',

  // Galeri Dokumentasi
  'admin.gallery.index': () => '/admin/gallery',
  'admin.gallery.create': () => '/admin/gallery/create',
  'admin.gallery.store': () => '/admin/gallery',
  'admin.gallery.edit': (id) => `/admin/gallery/${id}/edit`,
  'admin.gallery.update': (id) => `/admin/gallery/${id}`,
  'admin.gallery.destroy': (id) => `/admin/gallery/${id}`,
  'admin.gallery.toggle': (id) => `/admin/gallery/${id}/toggle`,
  'admin.gallery.bulk-delete': () => '/admin/gallery/bulk-delete',

  // Mitra Rekanan
  'admin.partners.index': () => '/admin/partners',
  'admin.partners.store': () => '/admin/partners',
  'admin.partners.update': (id) => `/admin/partners/${id}`,
  'admin.partners.destroy': (id) => `/admin/partners/${id}`,

  // Armada Bus
  'admin.fleets.index': () => '/admin/fleets',
  'admin.fleets.store': () => '/admin/fleets',
  'admin.fleets.update': (id) => `/admin/fleets/${id}`,
  'admin.fleets.destroy': (id) => `/admin/fleets/${id}`,

  // Pesan Masuk / Inquiries
  'admin.inquiries.index': () => '/admin/inquiries',
  'admin.inquiries.export': (query = '') => `/admin/inquiries/export${query ? '?' + query : ''}`,
  'admin.inquiries.status': (id) => `/admin/inquiries/${id}/status`,
  'admin.inquiries.destroy': (id) => `/admin/inquiries/${id}`,
  'admin.inquiries.bulk-delete': () => '/admin/inquiries/bulk-delete',

  // Testimonial Pelanggan
  'admin.testimonials.index': () => '/admin/testimonials',
  'admin.testimonials.store': () => '/admin/testimonials',
  'admin.testimonials.update': (id) => `/admin/testimonials/${id}`,
  'admin.testimonials.destroy': (id) => `/admin/testimonials/${id}`,
  'admin.testimonials.toggle': (id) => `/admin/testimonials/${id}/toggle`,
  'admin.testimonials.bulk-delete': () => '/admin/testimonials/bulk-delete',

  // Pengguna Administrator
  'admin.users.index': () => '/admin/users',
  'admin.users.store': () => '/admin/users',
  'admin.users.update': (id) => `/admin/users/${id}`,
  'admin.users.destroy': (id) => `/admin/users/${id}`,

  // Pengaturan
  'admin.settings.index': () => '/admin/settings',
  'admin.settings.update': () => '/admin/settings',
};

export function route(name, params) {
  if (!name) {
    return {
      current: (pattern) => {
        const path = window.location.pathname;
        if (!pattern) return false;
        if (pattern.endsWith('*')) {
          const prefix = pattern.slice(0, -1).replace('admin.', '/admin/').replace('.', '/');
          return path.startsWith(prefix) || (prefix === '/admin/' && path === '/admin');
        }
        const target = routes[pattern] ? routes[pattern](params) : '';
        return path === target;
      },
    };
  }

  const resolver = routes[name];
  if (!resolver) {
    console.warn(`Route [${name}] not defined.`);
    return `/${name.replace('admin.', 'admin/').replace('.', '/')}`;
  }

  return resolver(params);
}
