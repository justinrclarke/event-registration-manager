import { PrismaClient } from '@prisma/client'

const prisma = new PrismaClient()

async function main() {
    const john = await prisma.registrant.upsert({
        where: { company_email: "john_doe@company.com" },
        update: {},
        create: {
            first_name: "John",
            last_name: "Doe",
            company_email: "john_doe@company.com",
            company_name: "Company",
            company_phone: "555-555-5555",
            checked_in: true,
            walk_in: false,
            created_at: new Date(),
            updated_at: new Date()
        },
    })
    console.log({john})
}

main()
  .then(async () => {
    await prisma.$disconnect()
  })
  .catch(async (e) => {
    console.error(e)
    await prisma.$disconnect()
    process.exit(1)
  })