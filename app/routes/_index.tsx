import type { MetaFunction } from "@remix-run/node";
import { getAllRegistrants } from "prisma/registrant";
import type { GetAllRegistrants } from "./registrants.enum";

export const meta: MetaFunction = () => {
  return [
    { title: "Check-In" },
    { name: "description", content: "Event registration check-in manager." },
  ];
};

const allRegistrants = await getAllRegistrants();

export default function Index() {
  return (
    <main className="container p-8 m-auto">
      <div className="flex flex-row justify-between mb-8">
        <h1 className="uppercase">Event Registration</h1>
        <div className="flex flex-row">
          <button className="mr-4">Upload Registrations</button>
          <button>Add Walk-In</button>
        </div>
      </div>
      <div>
        <div className="table w-full">
          <div className="table-header-group">
            <div className="table-row">
              <p className="table-cell">First Name</p>
              <p className="table-cell">Last Name</p>
              <p className="table-cell">Company Name</p>
              <p className="table-cell">Company Email</p>
              <p className="table-cell">Company Phone</p>
              <p className="table-cell">Checked In?</p>
              <p className="table-cell">Walk In?</p>
            </div>
          </div>
          <div className="table-group">
            {allRegistrants.map((registrant: GetAllRegistrants) => {
              return (
                <div className="table-row" key={registrant.id}>
                  <p className="table-cell">{registrant.first_name}</p>
                  <p className="table-cell">{registrant.last_name}</p>
                  <p className="table-cell">{registrant.company_name}</p>
                  <p className="table-cell">{registrant.company_email}</p>
                  <p className="table-cell">{registrant.company_phone}</p>
                  <p className="table-cell">Checked In?</p>
                  <p className="table-cell">Walk In?</p>
                </div>  
              )
            })}
          </div>
        </div>
      </div>
    </main>
  );
}
