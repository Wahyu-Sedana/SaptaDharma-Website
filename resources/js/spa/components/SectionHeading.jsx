export default function SectionHeading({ eyebrow, title, description, align = 'left', light = false }) {
    return (
        <div className={align === 'center' ? 'mx-auto max-w-2xl text-center' : 'max-w-2xl'}>
            {eyebrow && (
                <span
                    className={`inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-semibold tracking-wide uppercase ${
                        light ? 'bg-white/10 text-green-300' : 'bg-green-50 text-green-600 dark:bg-green-500/10 dark:text-green-400'
                    }`}
                >
                    <span className="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                    {eyebrow}
                </span>
            )}
            <h2
                className={`text-balance mt-4 text-3xl font-bold tracking-tight sm:text-4xl ${
                    light ? 'text-white' : 'text-slate-900 dark:text-white'
                }`}
            >
                {title}
            </h2>
            {description && (
                <p
                    className={`mt-4 leading-relaxed ${light ? 'text-slate-300' : 'text-slate-600 dark:text-slate-400'}`}
                >
                    {description}
                </p>
            )}
        </div>
    );
}
