export function Input({ className = "", ...props }) {
  return (
    <input
      {...props}
      className={`block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 hover:bg-gray-100 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 disabled:bg-gray-200 sm:text-sm/6 ${className}`}
    />
  );
}
