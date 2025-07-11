export function FormRow({ label, htmlFor, children, action }) {
  return (
    <div>
      <div className="flex items-center justify-between">
        <label
          htmlFor={htmlFor}
          className="block text-sm/6 font-medium text-gray-900"
        >
          {label}
        </label>
        {action && <div className="text-sm">{action}</div>}
      </div>
      <div className="mt-2">{children}</div>
    </div>
  );
}
