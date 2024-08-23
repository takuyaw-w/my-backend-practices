import { drizzle } from 'drizzle-orm/postgres-js'
import postgres from 'postgres'
import { statuses } from './schema'
import 'dotenv/config'

const client = postgres(process.env.DATABASE_URL as string, { max: 1 })
const db = drizzle(client, { logger: true })

async function main() {
    await db.insert(statuses).values([
        {
            name: '未着手',
            created_at: '2024-01-01 00:00:00',
            updated_at: '2024-01-01 00:00:00'
        },
        {
            name: '進行中',
            created_at: '2024-01-01 00:00:00',
            updated_at: '2024-01-01 00:00:00'
        },
        {
            name: 'レビュー待ち',
            created_at: '2024-01-01 00:00:00',
            updated_at: '2024-01-01 00:00:00'
        },
        {
            name: '完了',
            created_at: '2024-01-01 00:00:00',
            updated_at: '2024-01-01 00:00:00'
        },
        {
            name: '保留',
            created_at: '2024-01-01 00:00:00',
            updated_at: '2024-01-01 00:00:00'
        }
    ])

    client.end()
}

main()
