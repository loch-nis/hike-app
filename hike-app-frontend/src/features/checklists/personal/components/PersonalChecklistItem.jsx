import { Checkbox } from "react-aria-components";
import { useTogglePersonalChecklistItem } from "../hooks/useTogglePersonalChecklistItem";
import { useDeletePersonalChecklistItem } from "../hooks/useDeletePersonalChecklistItem";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faXmark } from "@fortawesome/free-solid-svg-icons";

export function PersonalChecklistItem({ item }) {
  const { isChecked, toggleItem, isPending } =
    useTogglePersonalChecklistItem(item);
  const { deleteItem } = useDeletePersonalChecklistItem();

  return (
    <li className="flex items-center justify-between">
      <div className="group flex cursor-pointer space-x-2">
        <MyCheckbox
          checked={isChecked}
          onChange={() => toggleItem({ itemId: item.id })}
        />
        <span
          onClick={() => toggleItem({ itemId: item.id })}
          className={`${isChecked && "line-through"} group-hover:text-brand-orange group-hover:line-through`}
        >
          {item.content}
        </span>
        <span className="hidden lg:group-hover:block">👈</span>
      </div>
      <button
        className="cursor-pointer"
        onClick={() => deleteItem({ itemId: item.id })}
      >
        <FontAwesomeIcon
          icon={faXmark}
          className="text-3xl hover:text-red-500"
        />
      </button>
    </li>
  );
}

export function MyCheckbox({ checked, onChange }) {
  return (
    <Checkbox
      isSelected={checked}
      onChange={onChange}
      className="group flex cursor-pointer items-center gap-2"
    >
      {({ isSelected }) => (
        <>
          <div
            className={`flex h-5 w-5 items-center justify-center rounded border-2 text-white transition ${isSelected ? "border-brand-orange bg-brand-orange" : "border-gray-400 bg-white"} group-hover:border-brand-bronze`}
          >
            {isSelected && (
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
            )}
          </div>
        </>
      )}
    </Checkbox>
  );
}
