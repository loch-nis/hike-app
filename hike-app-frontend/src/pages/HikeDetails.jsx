import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import BackButton from "../ui/BackButton";

const personalChecklistExample = {};
const commonChecklistExample = {};

export default function HikeDetails() {
  const { hikeId } = useParams();
  const [title, setTitle] = useState(null);

  console.log(hikeId);

  useEffect(() => {
    if (!hikeId) return;
    async function fetchHikeDetails() {
      const response = await fetch(`http://127.0.0.1:8000/api/hikes/${hikeId}`);
      const data = await response.json();
      setTitle(data.title);
    }
    fetchHikeDetails();
  }, [hikeId]);

  return (
    <>
      <BackButton />
      <Title title={title} />
      <div className="flex justify-center gap-10">
        <ChecklistBox>
          <PersonalChecklist />
        </ChecklistBox>
        <ChecklistBox>
          <CommonChecklist />
        </ChecklistBox>
      </div>
    </>
  );
}

function Title({ title }) {
  return (
    <div>
      <h1 className="mt-5 mb-10 text-center font-sans text-5xl">{title}</h1>
    </div>
  );
}

function ChecklistBox({ children }) {
  return (
    <div className="relative w-[24rem] max-w-[24rem] bg-[var(--color-background-500)] font-mono">
      {children}
    </div>
  );
}

function PersonalChecklist({ hikeList }) {
  return (
    <ul>
      Personlig huskeliste
      {/* {hikeList.map((item) => (
        <PersonalChecklistItem />
      ))} */}
    </ul>
  );
}
function PersonalChecklistItem({ item }) {
  return (
    <div>
      <input type="checkbox" checked={item.is_checked} />
    </div>
  );
}
// todo destructure checklist items from snake case to lower camel case

function CommonChecklist() {
  return <ul>Fællesgrej</ul>;
}
