const BASE_URL = '/api';

async function request(path, locale) {
    const url = new URL(`${BASE_URL}${path}`, window.location.origin);

    if (locale) {
        url.searchParams.set('lang', locale);
    }

    const response = await fetch(url.toString(), {
        headers: { Accept: 'application/json' },
    });

    if (!response.ok) {
        throw new Error(`Request to ${path} failed with status ${response.status}`);
    }

    return response.json();
}

export const api = {
    settings: (locale) => request('/settings', locale),
    home: (locale) => request('/home', locale),
    teachings: (locale) => request('/teachings', locale),
    history: (locale) => request('/history', locale),
    articles: (params = '', locale) => request(`/articles${params}`, locale),
    article: (slug, locale) => request(`/articles/${slug}`, locale),
    books: (params = '', locale) => request(`/books${params}`, locale),
    book: (slug, locale) => request(`/books/${slug}`, locale),
    locations: (locale) => request('/locations', locale),
};
