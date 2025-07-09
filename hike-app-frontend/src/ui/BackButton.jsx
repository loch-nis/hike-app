import { useNavigate } from "react-router-dom";

export default function BackButton({ children }) {
  const navigate = useNavigate();
  return (
    <button
      className="bg-brand-orange absolute flex aspect-square cursor-pointer items-center justify-center rounded-full px-2 font-sans text-4xl font-bold text-gray-50 shadow-xl"
      onClick={() => navigate(-1)}
    >
      &larr; {children}
    </button>
  );
}
/*   position: absolute;
    top: 0.6rem;
    left: 0.6rem;
    height: 3.2rem;
    aspect-ratio: 1;
    border-radius: 50%;
    border: none;
    background-color: #fff;
    color: var(--color-background-500);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.8);
    font-family: sans-serif;
    font-size: 2.4rem;
    font-weight: bold;
    cursor: pointer;
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: center; */
