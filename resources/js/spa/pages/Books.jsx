import { Link, useSearchParams } from 'react-router-dom';
import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import Loading from '../components/Loading';
import ErrorState from '../components/ErrorState';
import Hero from '../components/Hero';
import SectionHeading from '../components/SectionHeading';

export default function Books() {
    const { locale } = useLocale();
    const [searchParams, setSearchParams] = useSearchParams();
    const category = searchParams.get('category') ?? '';
    const page = searchParams.get('page') ?? '1';

    const query = new URLSearchParams();
    if (category) query.set('category', category);
    if (page !== '1') query.set('page', page);
    const queryString = query.toString() ? `?${query.toString()}` : '';

    const { data, loading, error } = useFetch(() => api.books(queryString, locale), [category, page, locale]);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState />;

    const { hero, sections, categories, books, meta } = data;

    function selectCategory(slug) {
        const next = new URLSearchParams();
        if (slug) next.set('category', slug);
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

            <section className="py-24">
                <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    {sections?.list && <SectionHeading title={sections.list.title} />}

                    <div className="mt-8 mb-12 flex flex-wrap gap-2">
                        <button
                            type="button"
                            onClick={() => selectCategory('')}
                            className={`rounded-full px-4 py-2 text-sm font-medium transition ${
                                !category
                                    ? 'bg-green-500 text-white shadow-lg shadow-green-500/25'
                                    : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-green-50 dark:hover:bg-green-500/10'
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
                                        : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-green-50 dark:hover:bg-green-500/10'
                                }`}
                            >
                                {cat.name}
                            </button>
                        ))}
                    </div>

                    {books?.length === 0 ? (
                        <p className="text-slate-500 dark:text-slate-400">Belum ada buku untuk kategori ini.</p>
                    ) : (
                        <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                            {books.map((book) => (
                                <Link
                                    key={book.id}
                                    to={`/buku/${book.slug}`}
                                    className="group overflow-hidden rounded-3xl bg-white dark:bg-slate-900 shadow-sm ring-1 ring-slate-900/5 dark:ring-white/10 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                                >
                                    <div className="overflow-hidden">
                                        <img
                                            src={book.cover}
                                            alt={book.title}
                                            className="h-56 w-full object-cover transition duration-500 group-hover:scale-105"
                                        />
                                    </div>
                                    <div className="p-5">
                                        <span className="inline-flex rounded-full bg-green-50 dark:bg-green-500/10 px-2.5 py-0.5 text-xs font-semibold text-green-600 uppercase">
                                            {book.category?.name}
                                        </span>
                                        <h3 className="mt-2 line-clamp-2 font-semibold text-slate-900 dark:text-white transition group-hover:text-green-600">
                                            {book.title}
                                        </h3>
                                        <p className="mt-1 text-sm text-slate-500 dark:text-slate-400">{book.author}</p>
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
                                            : 'bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 hover:bg-green-50 dark:hover:bg-green-500/10'
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
