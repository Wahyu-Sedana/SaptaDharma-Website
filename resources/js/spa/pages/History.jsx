import { Link } from 'react-router-dom';
import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import Loading from '../components/Loading';
import ErrorState from '../components/ErrorState';
import Hero from '../components/Hero';
import SectionHeading from '../components/SectionHeading';

function HighlightSlider({ highlights }) {
    return (
        <div className="space-y-6">
            {highlights.map((item) => (
                <div
                    key={item.id}
                    className="flex flex-col items-center gap-6 overflow-hidden rounded-3xl bg-white shadow-sm ring-1 ring-slate-900/5 dark:bg-slate-900 dark:ring-white/10 sm:flex-row"
                >
                    <img src={item.image} alt={item.title} className="h-48 w-full object-cover sm:h-36 sm:w-56 sm:shrink-0" />
                    <div className="flex-1 px-6 sm:px-0">
                        <p className="text-lg font-medium text-slate-700 dark:text-slate-300">{item.title}</p>
                        {item.excerpt && (
                            <p className="mt-1 text-sm text-slate-500 dark:text-slate-400">{item.excerpt}</p>
                        )}
                    </div>
                    <Link
                        to={`/sejarah/${item.slug}`}
                        className="mb-6 inline-flex shrink-0 items-center gap-2 rounded-full bg-green-600 px-6 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-green-700 sm:mr-6 sm:mb-0"
                    >
                        Lihat Detail
                        <i className="fas fa-arrow-right text-xs"></i>
                    </Link>
                </div>
            ))}
        </div>
    );
}

export default function History() {
    const { locale } = useLocale();
    const { data, loading, error } = useFetch(() => api.history(locale), [locale]);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState />;

    const { hero, sections, highlights, timelines, founders } = data;

    return (
        <div>
            <Hero hero={hero} breadcrumb="Sejarah" compact />

            {sections?.about && (
                <section className="py-24">
                    <div className="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
                        <SectionHeading title={sections.about.title} align="center" />
                        <div
                            className="prose prose-slate dark:prose-invert mx-auto mt-6 max-w-none text-center leading-relaxed text-slate-600 dark:text-slate-400"
                            dangerouslySetInnerHTML={{ __html: sections.about.description }}
                        />
                    </div>
                </section>
            )}

            {highlights?.length > 0 && (
                <section className="pb-24">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <HighlightSlider highlights={highlights} />
                    </div>
                </section>
            )}

            {sections?.timeline && timelines?.length > 0 && (
                <section className="bg-slate-50 dark:bg-slate-900/50 py-24">
                    <div className="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                        <SectionHeading title={sections.timeline.title} align="center" />

                        <div className="relative mt-14 space-y-10 border-l-2 border-green-200 pl-10">
                            {timelines.map((item) => (
                                <div key={item.id} className="relative">
                                    <div className="absolute top-1 -left-[3.15rem] flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-green-500 to-emerald-400 text-white shadow-lg shadow-green-500/25">
                                        <i className={`${item.icon} text-xs`}></i>
                                    </div>
                                    <span className="inline-flex rounded-full bg-green-50 dark:bg-green-500/10 px-3 py-1 text-xs font-semibold text-green-600">
                                        {item.year}
                                    </span>
                                    <h3 className="mt-3 font-semibold text-slate-900 dark:text-white">{item.title}</h3>
                                    <p className="mt-1 text-sm leading-relaxed text-slate-600 dark:text-slate-400">{item.description}</p>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            )}

            {sections?.founders && founders?.length > 0 && (
                <section className="py-24">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <SectionHeading title={sections.founders.title} align="center" />

                        <div className="mt-14 grid gap-10 sm:grid-cols-2 lg:grid-cols-3">
                            {founders.map((founder) => (
                                <div key={founder.id} className="group text-center">
                                    <div className="mx-auto mb-5 h-40 w-40 overflow-hidden rounded-full shadow-xl shadow-slate-900/10 ring-4 ring-white">
                                        <img
                                            src={founder.image}
                                            alt={founder.name}
                                            className="h-full w-full object-cover transition duration-500 group-hover:scale-110"
                                        />
                                    </div>
                                    <h3 className="font-semibold text-slate-900 dark:text-white">{founder.name}</h3>
                                    <p className="text-sm font-medium text-green-600">{founder.position}</p>
                                    <p className="mt-2 text-sm text-slate-500 dark:text-slate-400">{founder.description}</p>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            )}
        </div>
    );
}
