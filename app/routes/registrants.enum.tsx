// app/routes/registrants.enum.tsx

export type GetAllRegistrants = {
    id: number,
    first_name: string,
    last_name: string,
    company_name: string,
    company_email: string,
    company_phone: string,
    checked_in: boolean,
    walk_in: boolean,
    created_at: Date,
    updated_at: Date,
}

export type CreateRegistrant = {
    first_name: string,
    last_name: string,
    company_name: string,
    company_email: string,
    company_phone: string,
    checked_in: boolean,
    walk_in: boolean,
    created_at: Date,
    updated_at: Date,   
}

export type UpdateRegistrant = {
    id?: number,
    first_name: string,
    last_name: string,
    company_name: string,
    company_email: string,
    company_phone: string,
    checked_in: boolean,
    walk_in: boolean,
    created_at: Date,
    updated_at: Date,
}