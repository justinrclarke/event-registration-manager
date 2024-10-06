// prisma/registrant.ts

import { PrismaClient } from "@prisma/client";
import type { CreateRegistrant, UpdateRegistrant } from "~/routes/registrants.enum";

const db = new PrismaClient();

export const getAllRegistrants = async () => {
    return await db.registrant.findMany();
}

export const getRegistrantById = async (id: number) => {
    return await db.registrant.findUnique({
        where: {
            id,
        },
    });
};

export const createRegistrant = async (registrant: CreateRegistrant) => {
    try {
        return await db.registrant.create({data: registrant});
    } catch (error) {
        console.error("Error creating registrant:", registrant);
        throw error;
    }
}

export const updateRegistrant = async (id: number, registrant: UpdateRegistrant) => {
    return await db.registrant.update({
        where: {
            id,
        },
        data: registrant,
    });
};

export const deleteRegistrant = async (id: number) => {
    return await db.registrant.delete({
        where: {
            id,
        },
    });
};