import { useToggleCommonChecklistItem } from "../hooks/useToggleCommonChecklistItem";
import { useDeleteCommonChecklistItem } from "../hooks/useDeleteCommonChecklistItem";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faXmark } from "@fortawesome/free-solid-svg-icons";
import { Checkbox } from "../../components/Checkbox";

export function CommonChecklistItem({ item }) {
  const { toggleItem } = useToggleCommonChecklistItem();
  const { deleteItem } = useDeleteCommonChecklistItem();

  return (
    <li className="flex items-center justify-between">
      <div className="group flex cursor-pointer space-x-2">
        <Checkbox
          checked={item.isChecked}
          onChange={() => toggleItem({ itemId: item.id })}
        />
        <span
          onClick={() => toggleItem({ itemId: item.id })}
          className={`${item.isChecked && "line-through opacity-30 transition"} group-hover:text-brand-orange`}
        >
          {item.content}
        </span>
        <span className="hidden lg:group-hover:block">👈</span>
      </div>
      <button
        type="button"
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
// todo extract the ui into a shared "checklistItem" component?! Do be careful of premature optimization / YAGNI
