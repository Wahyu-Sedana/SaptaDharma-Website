import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import Loading from '../components/Loading';
import ErrorState from '../components/ErrorState';
import Hero from '../components/Hero';
import SectionHeading from '../components/SectionHeading';

export default function Wejangans() {
    const { locale } = useLocale();
    const { data, loading, error } = useFetch(() => api.wejangan(locale), [locale]);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState />;

    const { hero, sections, wejangans } = data;

    return (
        <div>
            <Hero hero={hero} breadcrumb="Wejangan" compact />

            <section className="py-24">
                <div className="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
                    {sections?.list && <SectionHeading title={sections.list.title} align="center" />}

                    {wejangans?.length === 0 ? (
                        <p className="mt-8 text-center text-slate-500 dark:text-slate-400">Belum ada wejangan.</p>
                    ) : (
                        <ol className="mt-12 space-y-6">
                            {wejangans.map((item, index) => (
                                <li
                                    key={item.id}
                                    className="flex gap-5 rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-900/5 dark:bg-slate-900 dark:ring-white/10"
                                >
                                    <span className="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-green-50 text-sm font-bold text-green-600 dark:bg-green-500/10 dark:text-green-400">
                                        {index + 1}
                                    </span>
                                    <p className="text-lg leading-relaxed text-slate-700 italic dark:text-slate-300">
                                        “{item.content}”
                                    </p>
                                </li>
                            ))}
                        </ol>
                    )}
                </div>
            </section>
        </div>
    );
}
