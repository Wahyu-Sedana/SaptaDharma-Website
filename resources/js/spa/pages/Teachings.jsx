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
    const [activeValueIndex, setActiveValueIndex] = useState(0);
    const [activeIndex, setActiveIndex] = useState(0);

    if (loading) return <Loading />;
    if (error || !data) return <ErrorState />;

    const { hero, sections, luhur_values, pokok_ajarans } = data;
    const activeValue = luhur_values?.[activeValueIndex];
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
                            description={sections.values.description}
                            align="center"
                        />

                        <div className="mt-14 grid gap-8 lg:grid-cols-3">
                            <div className="space-y-2 lg:col-span-1">
                                {luhur_values?.map((value, index) => (
                                    <button
                                        key={value.id}
                                        type="button"
                                        onClick={() => setActiveValueIndex(index)}
                                        className={`flex w-full items-center gap-3 rounded-2xl px-5 py-4 text-left text-sm font-medium transition ${
                                            index === activeValueIndex
                                                ? 'bg-green-500 text-white shadow-lg shadow-green-500/25'
                                                : 'bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 shadow-sm ring-1 ring-slate-900/5 dark:ring-white/10 hover:bg-green-50 dark:hover:bg-green-500/10'
                                        }`}
                                    >
                                        <span
                                            className={`flex h-9 w-9 shrink-0 items-center justify-center rounded-xl ${
                                                index === activeValueIndex ? 'bg-white/20' : 'bg-green-50 dark:bg-green-500/10'
                                            }`}
                                        >
                                            <i className={`${value.icon} ${index === activeValueIndex ? 'text-white' : 'text-green-500'}`}></i>
                                        </span>
                                        {value.title}
                                    </button>
                                ))}
                            </div>

                            <div className="rounded-3xl bg-white dark:bg-slate-900 p-8 shadow-sm ring-1 ring-slate-900/5 dark:ring-white/10 lg:col-span-2">
                                {activeValue && (
                                    <>
                                        <div className="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-green-500 to-emerald-400 text-white shadow-lg shadow-green-500/20">
                                            <i className={`${activeValue.icon} text-2xl`}></i>
                                        </div>
                                        <h3 className="text-xl font-bold text-slate-900 dark:text-white">{activeValue.title}</h3>
                                        <p className="mt-4 leading-relaxed text-slate-600 dark:text-slate-400">{activeValue.description}</p>
                                    </>
                                )}
                            </div>
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
                                        <div
                                            className="prose prose-slate dark:prose-invert mt-4 max-w-none leading-relaxed text-slate-600 dark:text-slate-400"
                                            dangerouslySetInnerHTML={{ __html: activeItem.description }}
                                        />
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
