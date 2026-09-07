import { Link, useParams } from 'react-router-dom';
import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import Loading from '../components/Loading';
import ErrorState from '../components/ErrorState';
import Hero from '../components/Hero';

export default function HistoryHighlightDetail() {
    const { locale } = useLocale();
    const { slug } = useParams();
    const { data, loading, error } = useFetch(() => api.historyHighlight(slug, locale), [slug, locale]);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState message="Data sejarah tidak ditemukan." />;

    const { hero, highlight } = data;

    return (
        <article>
            <Hero hero={hero} breadcrumb="Sejarah" compact />

            <section className="py-20">
                <div className="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                    <nav className="mb-8 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                        <Link to="/" className="hover:text-green-600">
                            Home
                        </Link>
                        <i className="fas fa-chevron-right text-[10px]"></i>
                        <Link to="/sejarah" className="hover:text-green-600">
                            Sejarah
                        </Link>
                        <i className="fas fa-chevron-right text-[10px]"></i>
                        <span className="font-medium text-green-600">{highlight.title}</span>
                    </nav>

                    <img
                        src={highlight.image}
                        alt={highlight.title}
                        className="h-80 w-full rounded-3xl object-cover shadow-xl shadow-slate-900/10"
                    />

                    <h1 className="mt-8 text-2xl font-bold text-slate-900 dark:text-white sm:text-3xl">{highlight.title}</h1>

                    {highlight.description && (
                        <div
                            className="prose prose-slate dark:prose-invert prose-lg mt-6 max-w-none leading-relaxed"
                            dangerouslySetInnerHTML={{ __html: highlight.description }}
                        />
                    )}
                </div>
            </section>
        </article>
    );
}
