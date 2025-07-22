import { Checkbox as AriaCheckbox } from "react-aria-components";

export function Checkbox({ checked, onChange }) {
  return (
    <AriaCheckbox
      isSelected={checked}
      onChange={onChange}
      className="group flex cursor-pointer items-center gap-2"
    >
      {({ isSelected }) => (
        <>
          <div
            className={`flex h-5 w-5 items-center justify-center rounded border-2 text-white transition ${isSelected ? "border-brand-orange bg-brand-orange" : "border-gray-400 bg-white"} group-hover:border-brand-bronze`}
          >
            {isSelected ? (
              <svg
                viewBox="0 0 18 18"
                className="h-3 w-3 stroke-white"
                aria-hidden="true"
              >
                <polyline
                  points="1 9 7 14 15 4"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                />
              </svg>
            ) : (
              ""
            )}
          </div>
        </>
      )}
    </AriaCheckbox>
  );
}
