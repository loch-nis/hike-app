import { Link } from "react-router-dom";
import { useAuth } from "../context/AuthContext";

export function Header() {
  const { user, logout } = useAuth();

  return (
    <header className="z-20 bg-gray-50 p-2 shadow-lg">
      <div className="flex items-center justify-between">
        <div className="flex items-center space-x-4">
          <Link to={"/hikes"}>My Hikes</Link>
          <h1>Hike App</h1>
        </div>
        <div className="flex items-center space-x-4">
          <h2>Hello, {user.first_name} ☀</h2>
          <button onClick={() => logout()}>Log out temp</button>
        </div>
      </div>
    </header>
  );
}
