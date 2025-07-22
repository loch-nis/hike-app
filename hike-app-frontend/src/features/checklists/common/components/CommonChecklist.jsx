import { useEcho } from "@laravel/echo-react";
import { CommonChecklistItem } from "./CommonChecklistItem";
import { useQueryClient } from "@tanstack/react-query";

export function CommonChecklist({ commonChecklistId, items }) {
  const queryClient = useQueryClient();

  useEcho(
    `commonChecklist.${commonChecklistId}`,
    "CommonChecklistUpdated",
    () => queryClient.invalidateQueries({ queryKey: ["commonChecklist"] }),
  );

  const amountOfItemsChecked = items.filter(
    (item) => item.isChecked === 1,
  ).length;

  const percentageOfItemsChecked = (amountOfItemsChecked / items.length) * 100;

  return (
    <>
      <h3 className="py-2 text-center font-semibold">
        Common Checklist ({Math.round(percentageOfItemsChecked)}% Complete)
      </h3>
      <ul className="flex flex-col space-y-0.5 pb-2">
        {items.map((item) => (
          <CommonChecklistItem item={item} key={item.id} />
        ))}
      </ul>
    </>
  );
}
