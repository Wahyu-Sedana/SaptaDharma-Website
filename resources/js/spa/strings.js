const STRINGS = {
    id: {
        home: 'Beranda',
        teachings: 'Ajaran',
        history: 'Sejarah',
        articles: 'Artikel',
        books: 'Buku',
        locations: 'Lokasi',
    },
    en: {
        home: 'Home',
        teachings: 'Teachings',
        history: 'History',
        articles: 'Articles',
        books: 'Books',
        locations: 'Locations',
    },
};

export function t(locale, key) {
    return STRINGS[locale]?.[key] ?? STRINGS.id[key] ?? key;
}
