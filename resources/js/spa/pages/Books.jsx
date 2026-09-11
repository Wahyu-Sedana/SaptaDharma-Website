import { useState } from 'react';
import { Link, useSearchParams } from 'react-router-dom';
import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import Loading from '../components/Loading';
import ErrorState from '../components/ErrorState';
import Hero from '../components/Hero';

export default function Books() {
    const { locale } = useLocale();
    const [searchParams, setSearchParams] = useSearchParams();
    const category = searchParams.get('category') ?? '';
    const page = searchParams.get('page') ?? '1';
    const search = searchParams.get('search') ?? '';
    const [searchInput, setSearchInput] = useState(search);

    const query = new URLSearchParams();
    if (category) query.set('category', category);
    if (search) query.set('search', search);
    if (page !== '1') query.set('page', page);
    const queryString = query.toString() ? `?${query.toString()}` : '';

    const { data, loading, error } = useFetch(() => api.books(queryString, locale), [category, search, page, locale]);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState />;

    const { hero, categories, books, meta } = data;

    function selectCategory(slug) {
        const next = new URLSearchParams(searchParams);
        next.delete('page');
        if (slug) {
            next.set('category', slug);
        } else {
            next.delete('category');
        }
        setSearchParams(next);
    }

    function submitSearch(e) {
        e.preventDefault();
        const next = new URLSearchParams(searchParams);
        next.delete('page');
        if (searchInput) {
            next.set('search', searchInput);
        } else {
            next.delete('search');
        }
        setSearchParams(next);
    }

    function goToPage(nextPage) {
        const next = new URLSearchParams(searchParams);
        next.set('page', String(nextPage));
        setSearchParams(next);
    }

    return (
        <div>
            <Hero hero={hero} breadcrumb="Buku" compact />

            <section className="py-16">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="mb-10 flex flex-wrap items-end justify-between gap-6">
                        <div>
                            <div className="mb-3 h-1 w-10 rounded-full bg-green-500" />
                            <h1 className="text-3xl font-bold text-slate-900 sm:text-4xl dark:text-white">Daftar Pustaka dan Dokumen</h1>
                            <p className="mt-2 text-slate-600 dark:text-slate-400">Sumber ajaran, sejarah, dan pedoman Sapta Darma</p>
                        </div>

                        <form onSubmit={submitSearch} className="relative w-full max-w-xs">
                            <i className="fas fa-search absolute top-1/2 left-4 -translate-y-1/2 text-slate-400 dark:text-slate-500"></i>
                            <input
                                type="text"
                                value={searchInput}
                                onChange={(e) => setSearchInput(e.target.value)}
                                placeholder="Cari dokumen..."
                                className="w-full rounded-full border border-slate-200 bg-slate-50 py-3 pr-4 pl-11 text-sm text-slate-900 placeholder:text-slate-400 focus:border-green-500 focus:outline-none dark:border-white/10 dark:bg-white/5 dark:text-white dark:placeholder:text-slate-500"
                            />
                        </form>
                    </div>

                    <div className="mb-10 flex flex-wrap gap-2">
                        <button
                            type="button"
                            onClick={() => selectCategory('')}
                            className={`rounded-full px-4 py-2 text-sm font-medium transition ${
                                !category
                                    ? 'bg-green-500 text-white shadow-lg shadow-green-500/25'
                                    : 'bg-slate-100 text-slate-600 hover:bg-green-50 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-green-500/10'
                            }`}
                        >
                            Semua
                        </button>
                        {categories?.map((cat) => (
                            <button
                                key={cat.id}
                                type="button"
                                onClick={() => selectCategory(cat.slug)}
                                className={`rounded-full px-4 py-2 text-sm font-medium transition ${
                                    category === cat.slug
                                        ? 'bg-green-500 text-white shadow-lg shadow-green-500/25'
                                        : 'bg-slate-100 text-slate-600 hover:bg-green-50 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-green-500/10'
                                }`}
                            >
                                {cat.name}
                            </button>
                        ))}
                    </div>

                    {books?.length === 0 ? (
                        <p className="text-slate-500 dark:text-slate-400">Tidak ada dokumen yang ditemukan.</p>
                    ) : (
                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                            {books.map((book) => (
                                <Link
                                    key={book.id}
                                    to={`/buku/${book.slug}`}
                                    className="group flex flex-col overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-900/5 transition duration-300 hover:-translate-y-1 hover:shadow-xl dark:bg-slate-900 dark:ring-white/10"
                                >
                                    <div className="overflow-hidden bg-slate-100 dark:bg-slate-800">
                                        <img
                                            src={book.cover}
                                            alt={book.title}
                                            className="h-56 w-full object-contain transition duration-500 group-hover:scale-105"
                                        />
                                    </div>
                                    <div className="flex flex-1 flex-col p-5">
                                        <span className="mb-3 inline-flex w-fit items-center rounded-full border border-green-500/40 px-3 py-1 text-xs font-semibold tracking-wide text-green-600 uppercase dark:text-green-400">
                                            {book.category?.name}
                                        </span>
                                        <h3 className="font-semibold text-slate-900 transition group-hover:text-green-600 dark:text-white dark:group-hover:text-green-400">
                                            {book.title}
                                        </h3>
                                        <p className="mt-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                                            <i className="far fa-file-alt"></i>
                                            {book.category?.name}
                                            {book.year && (
                                                <>
                                                    <span>|</span>
                                                    {book.year}
                                                </>
                                            )}
                                        </p>
                                        <div className="mt-auto pt-4">
                                            <span className="inline-flex items-center gap-2 rounded-full border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 transition group-hover:border-green-500 group-hover:text-green-600 dark:border-white/15 dark:text-slate-200 dark:group-hover:text-green-400">
                                                Baca dokumen
                                                <i className="fas fa-arrow-right text-xs transition group-hover:translate-x-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                </Link>
                            ))}
                        </div>
                    )}

                    {meta?.last_page > 1 && (
                        <div className="mt-14 flex justify-center gap-2">
                            {Array.from({ length: meta.last_page }, (_, i) => i + 1).map((p) => (
                                <button
                                    key={p}
                                    type="button"
                                    onClick={() => goToPage(p)}
                                    className={`h-10 w-10 rounded-full text-sm font-medium transition ${
                                        meta.current_page === p
                                            ? 'bg-green-500 text-white shadow-lg shadow-green-500/25'
                                            : 'bg-slate-100 text-slate-600 hover:bg-green-50 dark:bg-slate-800 dark:text-slate-400 dark:hover:bg-green-500/10'
                                    }`}
                                >
                                    {p}
                                </button>
                            ))}
                        </div>
                    )}
                </div>
            </section>
        </div>
    );
}
