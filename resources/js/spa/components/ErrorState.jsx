export default function ErrorState({ message = 'Gagal memuat data. Silakan coba lagi.' }) {
    return (
        <div className="flex min-h-[60vh] items-center justify-center px-4">
            <div className="max-w-sm text-center">
                <div className="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-green-50 dark:bg-green-500/10">
                    <i className="fas fa-triangle-exclamation text-2xl text-green-500"></i>
                </div>
                <p className="font-medium text-slate-700 dark:text-slate-300">{message}</p>
                <button
                    type="button"
                    onClick={() => window.location.reload()}
                    className="mt-6 inline-flex items-center gap-2 rounded-full bg-green-500 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-green-500/25 transition hover:-translate-y-0.5 hover:bg-green-600"
                >
                    <i className="fas fa-rotate-right"></i>
                    Muat Ulang
                </button>
            </div>
        </div>
    );
}
