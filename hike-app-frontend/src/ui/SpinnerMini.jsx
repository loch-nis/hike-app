// import styled, { keyframes } from "styled-components";
import { BiLoaderAlt } from "react-icons/bi";

/* const rotate = keyframes`
  to {
    transform: rotate(1turn)
  }
`;

export const SpinnerMini = styled(BiLoaderAlt)`
  width: 2.4rem;
  height: 2.4rem;
  animation: ${rotate} 1.5s infinite linear;
`; */

export function SpinnerMini() {
  return <BiLoaderAlt className="h-6 w-6 animate-spin text-gray-700" />;
}

// todo export everything as default (my components), except maybe custom hooks?!?!
