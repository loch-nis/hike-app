export function Button({ className = "", children, ...props }) {
  return (
    <button
      /* type="submit"
        disabled={isPending} */
      {...props}
      className={`bg-brand-orange hover:bg-brand-bronze disabled:bg-brand-bronze flex w-full cursor-pointer justify-center rounded-md px-3 py-1.5 text-sm/6 font-semibold text-white shadow-md focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 ${className}`}
    >
      {children}
    </button>
  );
}
