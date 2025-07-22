import { useParams } from "react-router-dom";
import { BackButton } from "../ui/BackButton";
import { useHike } from "../features/hikes/hooks/useHike";
import { Spinner } from "../ui/Spinner";
import { CommonChecklist } from "../features/checklists/common/components/CommonChecklist";
import { Title } from "../ui/Title";
import { PersonalChecklist } from "../features/checklists/personal/components/PersonalChecklist";
import { PersonalChecklistForm } from "../features/checklists/personal/components/PersonalChecklistForm";
import { ChecklistBox } from "../ui/ChecklistBox";
import { CommonChecklistForm } from "../features/checklists/common/components/CommonChecklistForm";
import { useCommonChecklist } from "../features/checklists/common/hooks/useCommonChecklist";

export function HikeDetails() {
  const { hikeId = "" } = useParams();
  const { hike, error, isPending, isError } = useHike({ hikeId });
  const { commonChecklistItems, commonChecklist } = useCommonChecklist({
    hikeId,
  });

  return (
    <>
      <BackButton />
      {isPending ? (
        <Spinner />
      ) : isError ? (
        <Error error={error} />
      ) : (
        <>
          <Title title={hike.title} />
          <div className="flex justify-center gap-10">
            <ChecklistBox>
              <PersonalChecklist hikeId={hikeId} />
              <PersonalChecklistForm hikeId={hikeId} />
            </ChecklistBox>
            <ChecklistBox>
              {commonChecklist && (
                <CommonChecklist
                  commonChecklistId={commonChecklist.id}
                  items={commonChecklistItems}
                />
              )}
              <CommonChecklistForm hikeId={hikeId} />
            </ChecklistBox>
          </div>
        </>
      )}
    </>
  );
}
