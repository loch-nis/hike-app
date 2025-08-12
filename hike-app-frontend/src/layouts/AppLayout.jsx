import { Outlet } from "react-router-dom";
import { Header } from "../ui/Header";

export function AppLayout() {
  return (
    <>
      <div className="relative min-h-screen">
        <div className="absolute inset-0 -z-10 block min-h-screen bg-[url(/the-tree-of-life.png)] bg-cover bg-center blur-xs"></div>
        <Header />
        <div className="flex justify-center">
          <div className="z-10 m-10 min-w-1/2 rounded-2xl bg-white p-10 pb-30 lg:shadow-2xl">
            <Outlet />
          </div>
        </div>
      </div>
    </>
  );
}
// todo parchment as bg? Or just the color?
