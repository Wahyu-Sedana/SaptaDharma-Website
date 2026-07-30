import { useState } from "react";
import { ChevronDown } from "lucide-react";
import { useLocale, LOCALES } from "../LocaleContext";

const LANGUAGES = {
    id: {
        name: "Indonesia",
        flag: "fi-id",
    },
    en: {
        name: "English",
        flag: "fi-gb",
    },
};

export default function LanguageSwitcher({ light = true }) {
    const { locale, setLocale } = useLocale();
    const [open, setOpen] = useState(false);

    const current = LANGUAGES[locale];

    return (
        <div className="relative">
            <button
                type="button"
                onClick={() => setOpen((v) => !v)}
                className={`flex items-center gap-2 rounded-full px-3 py-2 text-sm font-medium transition ${
                    light
                        ? "border border-white/10 bg-white/5 text-white hover:bg-white/10"
                        : "bg-slate-100 text-slate-700 hover:bg-slate-200"
                }`}
            >
                <span
                    className={`${current.flag} rounded-sm`}
                    style={{
                        width: "22px",
                        height: "16px",
                    }}
                />

                <span>{current.name}</span>

                <ChevronDown
                    size={15}
                    className={`transition-transform ${
                        open ? "rotate-180" : ""
                    }`}
                />
            </button>

            {open && (
                <div
                    className={`absolute right-0 mt-2 w-40 rounded-xl border p-1 shadow-lg backdrop-blur-md ${
                        light
                            ? "border-white/10 bg-slate-950/95"
                            : "border-slate-200 bg-white"
                    }`}
                >
                    {Object.entries(LANGUAGES).map(([code, lang]) => (
                        <button
                            key={code}
                            type="button"
                            onClick={() => {
                                setLocale(code);
                                setOpen(false);
                            }}
                            className={`flex w-full items-center gap-3 rounded-lg px-3 py-2 text-sm transition ${
                                locale === code
                                    ? "bg-orange-500 text-white"
                                    : light
                                      ? "text-slate-200 hover:bg-white/10"
                                      : "text-slate-700 hover:bg-slate-100"
                            }`}
                        >
                            <span
                                className={`${lang.flag} rounded-sm`}
                                style={{
                                    width: "22px",
                                    height: "16px",
                                }}
                            />

                            {lang.name}
                        </button>
                    ))}
                </div>
            )}
        </div>
    );
}
