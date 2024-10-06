import type { MetaFunction } from "@remix-run/node";

export const meta: MetaFunction = () => {
  return [
    { title: "Check-In" },
    { name: "description", content: "Event registration check-in manager." },
  ];
};

export default function Index() {
  return <></>;
}
