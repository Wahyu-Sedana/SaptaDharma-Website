import { useState } from 'react';
import { useFetch } from '../useFetch';
import { useLocale } from '../LocaleContext';
import { api } from '../api';
import Loading from '../components/Loading';
import ErrorState from '../components/ErrorState';
import Hero from '../components/Hero';
import SectionHeading from '../components/SectionHeading';

export default function Teachings() {
    const { locale } = useLocale();
    const { data, loading, error } = useFetch(() => api.teachings(locale), [locale]);
    const [activeIndex, setActiveIndex] = useState(0);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState />;

    const { hero, sections, luhur_values, pokok_ajarans } = data;
    const active = pokok_ajarans?.[activeIndex];
    const activeItem = active?.items?.[0];

    return (
        <div>
            <Hero hero={hero} breadcrumb="Wewarah" compact />

            {sections?.values && (
                <section className="py-24">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <SectionHeading
                            eyebrow={sections.values.subtitle}
                            title={sections.values.title}
                            align="center"
                        />

                        <div className="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
                            {luhur_values?.map((value) => (
                                <div
                                    key={value.id}
                                    className="group rounded-3xl bg-white dark:bg-slate-900 p-6 text-center shadow-sm ring-1 ring-slate-900/5 dark:ring-white/10 transition duration-300 hover:-translate-y-1 hover:shadow-xl"
                                >
                                    <div className="mx-auto mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-green-500 to-emerald-400 text-white shadow-lg shadow-green-500/20 transition group-hover:scale-110">
                                        <i className={`${value.icon} text-2xl`}></i>
                                    </div>
                                    <h3 className="font-semibold text-slate-900 dark:text-white">{value.title}</h3>
                                    <p className="mt-2 text-sm leading-relaxed text-slate-500 dark:text-slate-400">{value.description}</p>
                                </div>
                            ))}
                        </div>
                    </div>
                </section>
            )}

            {sections?.pokok_ajaran && pokok_ajarans?.length > 0 && (
                <section className="bg-slate-50 dark:bg-slate-900/50 py-24">
                    <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                        <SectionHeading eyebrow={sections.pokok_ajaran.subtitle} title={sections.pokok_ajaran.title} />

                        <div className="mt-12 grid gap-8 lg:grid-cols-3">
                            <div className="space-y-2 lg:col-span-1">
                                {pokok_ajarans.map((ajaran, index) => (
                                    <button
                                        key={ajaran.id}
                                        type="button"
                                        onClick={() => setActiveIndex(index)}
                                        className={`block w-full rounded-2xl px-5 py-4 text-left text-sm font-medium transition ${
                                            index === activeIndex
                                                ? 'bg-green-500 text-white shadow-lg shadow-green-500/25'
                                                : 'bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 shadow-sm ring-1 ring-slate-900/5 dark:ring-white/10 hover:bg-green-50 dark:hover:bg-green-500/10'
                                        }`}
                                    >
                                        <span className={index === activeIndex ? 'text-green-100' : 'text-green-500'}>
                                            {String(index + 1).padStart(2, '0')}
                                        </span>{' '}
                                        {ajaran.title}
                                    </button>
                                ))}
                            </div>

                            <div className="rounded-3xl bg-white dark:bg-slate-900 p-8 shadow-sm ring-1 ring-slate-900/5 dark:ring-white/10 lg:col-span-2">
                                {activeItem && (
                                    <>
                                        <img
                                            src={activeItem.image}
                                            alt={activeItem.title}
                                            className="mb-6 h-56 w-full rounded-2xl object-cover"
                                        />
                                        <h3 className="text-xl font-bold text-slate-900 dark:text-white">{activeItem.title}</h3>
                                        <p className="mt-4 leading-relaxed text-slate-600 dark:text-slate-400">{activeItem.description}</p>
                                        {activeItem.quote && (
                                            <blockquote className="mt-6 rounded-2xl bg-green-50 dark:bg-green-500/10 p-5 text-sm text-green-800 dark:text-green-300 italic">
                                                &ldquo;{activeItem.quote}&rdquo;
                                            </blockquote>
                                        )}
                                    </>
                                )}
                            </div>
                        </div>
                    </div>
                </section>
            )}
        </div>
    );
}
