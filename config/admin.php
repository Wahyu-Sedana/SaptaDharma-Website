<?php

return [

  'menu' => [

    // ===============================
    // Dashboard
    // ===============================
    [
      'group' => 'Dashboard',
      'icon'  => 'fa-gauge-high',

      'items' => [

        [
          'title' => 'Dashboard',
          'icon'  => 'fa-gauge-high',
          'route' => 'admin.dashboard',
        ],

      ],
    ],

    // ===============================
    // Website
    // ===============================
    [
      'group' => 'Website',
      'icon'  => 'fa-globe',

      'items' => [

        [
          'title' => 'Hero',
          'icon'  => 'fa-image',
          'route' => 'admin.heroes.index',
        ],

        [
          'title' => 'Sections',
          'icon'  => 'fa-layer-group',
          'route' => 'admin.sections.index',
        ],

        [
          'title' => 'Section Items',
          'icon'  => 'fa-list',
          'route' => 'admin.section-items.index',
        ],

      ],
    ],

    // ===============================
    // Artikel
    // ===============================
    [
      'group' => 'Artikel',
      'icon'  => 'fa-newspaper',

      'items' => [

        [
          'title' => 'Kategori',
          'icon'  => 'fa-folder',
          'route' => 'admin.article-categories.index',
        ],

        [
          'title' => 'Artikel',
          'icon'  => 'fa-newspaper',
          'route' => 'admin.articles.index',
        ],

      ],
    ],

    // ===============================
    // Buku
    // ===============================
    [
      'group' => 'Buku',
      'icon'  => 'fa-book',

      'items' => [

        [
          'title' => 'Kategori',
          'icon'  => 'fa-book-bookmark',
          'route' => 'admin.book-categories.index',
        ],

        [
          'title' => 'Buku',
          'icon'  => 'fa-book-open',
          'route' => 'admin.books.index',
        ],

      ],
    ],

    // ===============================
    // Ajaran
    // ===============================
    [
      'group' => 'Ajaran',
      'icon'  => 'fa-book-open',

      'items' => [

        [
          'title' => 'Nilai Luhur',
          'icon'  => 'fa-gem',
          'route' => 'admin.luhur-values.index',
        ],

        [
          'title' => 'Pokok Ajaran',
          'icon'  => 'fa-book',
          'route' => 'admin.pokok-ajarans.index',
        ],

        [
          'title' => 'Pokok Ajaran Item',
          'icon'  => 'fa-list-check',
          'route' => 'admin.pokok-ajaran-items.index',
        ],

      ],
    ],

    // ===============================
    // Sejarah
    // ===============================
    [
      'group' => 'Sejarah',
      'icon'  => 'fa-landmark',

      'items' => [

        [
          'title' => 'Timeline',
          'icon'  => 'fa-clock-rotate-left',
          'route' => 'admin.history-timelines.index',
        ],

        [
          'title' => 'Pendiri',
          'icon'  => 'fa-users',
          'route' => 'admin.founders.index',
        ],

      ],
    ],

    // ===============================
    // Lainnya
    // ===============================
    [
      'group' => 'Lainnya',
      'icon'  => 'fa-gear',

      'items' => [

        [
          'title' => 'Lokasi',
          'icon'  => 'fa-location-dot',
          'route' => 'admin.locations.index',
        ],

        [
          'title' => 'Galeri',
          'icon'  => 'fa-images',
          'route' => 'admin.galleries.index',
        ],

        [
          'title' => 'Pengaturan Website',
          'icon'  => 'fa-globe',
          'route' => 'admin.web-settings.index',
        ],

      ],
    ],

  ],

];
