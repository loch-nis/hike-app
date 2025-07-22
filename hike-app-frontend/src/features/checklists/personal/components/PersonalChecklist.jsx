import { PersonalChecklistItem } from "./PersonalChecklistItem";
import { usePersonalChecklist } from "../hooks/usePersonalChecklist";
import { Spinner } from "../../../../ui/Spinner";

export function PersonalChecklist({ hikeId }) {
  const {
    personalChecklistItems: items,
    error,
    isPending,
    isError,
  } = usePersonalChecklist({ hikeId });

  if (isError) return <Error error={error} />;

  if (isPending) return <Spinner />;

  const amountOfItemsChecked = items.filter(
    (item) => item.isChecked === 1,
  ).length;

  const percentageOfItemsChecked = (amountOfItemsChecked / items.length) * 100;

  return (
    <>
      <h3 className="py-2 text-center font-semibold">
        Personal Checklist ({Math.round(percentageOfItemsChecked)}% Complete)
      </h3>
      <ul className="flex flex-col space-y-0.5 pb-2">
        {items.map((item) => (
          <PersonalChecklistItem item={item} key={item.id} />
        ))}
      </ul>
    </>
  );
}
