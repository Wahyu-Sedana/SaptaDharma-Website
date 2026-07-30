export default function ErrorState({ message = 'Gagal memuat data. Silakan coba lagi.' }) {
    return (
        <div className="flex min-h-[60vh] items-center justify-center px-4">
            <div className="max-w-sm text-center">
                <div className="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-orange-50">
                    <i className="fas fa-triangle-exclamation text-2xl text-orange-500"></i>
                </div>
                <p className="font-medium text-slate-700">{message}</p>
                <button
                    type="button"
                    onClick={() => window.location.reload()}
                    className="mt-6 inline-flex items-center gap-2 rounded-full bg-orange-500 px-6 py-2.5 text-sm font-semibold text-white shadow-lg shadow-orange-500/25 transition hover:-translate-y-0.5 hover:bg-orange-600"
                >
                    <i className="fas fa-rotate-right"></i>
                    Muat Ulang
                </button>
            </div>
        </div>
    );
}
