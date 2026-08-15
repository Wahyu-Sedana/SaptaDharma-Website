export default function Loading() {
    return (
        <div>
            <div className="skeleton h-[55vh] w-full bg-slate-900" />

            <div className="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
                <div className="skeleton mb-4 h-4 w-32 rounded-full" />
                <div className="skeleton mb-10 h-8 w-72 rounded-full" />

                <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    {Array.from({ length: 3 }).map((_, i) => (
                        <div key={i} className="overflow-hidden rounded-2xl border border-slate-100 dark:border-slate-800">
                            <div className="skeleton h-48 w-full" />
                            <div className="space-y-3 p-5">
                                <div className="skeleton h-3 w-1/3 rounded-full" />
                                <div className="skeleton h-4 w-full rounded-full" />
                                <div className="skeleton h-4 w-2/3 rounded-full" />
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </div>
    );
}
