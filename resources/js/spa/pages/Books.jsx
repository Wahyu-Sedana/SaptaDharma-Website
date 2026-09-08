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

            <section className="bg-slate-950 py-16">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div className="mb-10 flex flex-wrap items-end justify-between gap-6">
                        <div>
                            <div className="mb-3 h-1 w-10 rounded-full bg-green-500" />
                            <h1 className="text-3xl font-bold text-white sm:text-4xl">Koleksi Dokumen</h1>
                            <p className="mt-2 text-slate-400">Sumber ajaran, sejarah, dan pedoman Sapta Darma</p>
                        </div>

                        <form onSubmit={submitSearch} className="relative w-full max-w-xs">
                            <i className="fas fa-search absolute top-1/2 left-4 -translate-y-1/2 text-slate-500"></i>
                            <input
                                type="text"
                                value={searchInput}
                                onChange={(e) => setSearchInput(e.target.value)}
                                placeholder="Cari dokumen..."
                                className="w-full rounded-full border border-white/10 bg-white/5 py-3 pr-4 pl-11 text-sm text-white placeholder:text-slate-500 focus:border-green-500 focus:outline-none"
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
                                    : 'border border-white/10 bg-white/5 text-slate-300 hover:bg-white/10'
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
                                        : 'border border-white/10 bg-white/5 text-slate-300 hover:bg-white/10'
                                }`}
                            >
                                {cat.name}
                            </button>
                        ))}
                    </div>

                    {books?.length === 0 ? (
                        <p className="text-slate-400">Tidak ada dokumen yang ditemukan.</p>
                    ) : (
                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                            {books.map((book) => (
                                <Link
                                    key={book.id}
                                    to={`/buku/${book.slug}`}
                                    className="group flex flex-col overflow-hidden rounded-2xl border border-white/10 bg-slate-900/60 transition duration-300 hover:-translate-y-1 hover:border-green-500/40"
                                >
                                    <div className="overflow-hidden bg-slate-800">
                                        <img
                                            src={book.cover}
                                            alt={book.title}
                                            className="h-56 w-full object-contain transition duration-500 group-hover:scale-105"
                                        />
                                    </div>
                                    <div className="flex flex-1 flex-col p-5">
                                        <span className="mb-3 inline-flex w-fit items-center rounded-full border border-green-500/40 px-3 py-1 text-xs font-semibold tracking-wide text-green-400 uppercase">
                                            {book.category?.name}
                                        </span>
                                        <h3 className="line-clamp-2 font-semibold text-white transition group-hover:text-green-400">
                                            {book.title}
                                        </h3>
                                        <p className="mt-2 flex items-center gap-2 text-sm text-slate-400">
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
                                            <span className="inline-flex items-center gap-2 rounded-full border border-white/15 px-4 py-2 text-sm font-medium text-white transition group-hover:border-green-500 group-hover:text-green-400">
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
                                            : 'border border-white/10 bg-white/5 text-slate-300 hover:bg-white/10'
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
