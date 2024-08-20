import { pgTable, serial, timestamp, varchar, text, uniqueIndex, foreignKey, integer } from 'drizzle-orm/pg-core'

const commonTimestampColumns = {
    created_at: timestamp('created_at', { withTimezone: true, mode: 'string' }).defaultNow(),
    updated_at: timestamp('updated_at', { withTimezone: true, mode: 'string' }).defaultNow(),
    deleted_at: timestamp('deleted_at', { withTimezone: true, mode: 'string' }),
}

export const statuses = pgTable('statuses', {
    id: serial('id'),
    name: varchar('name', { length: 50 }).notNull().unique(),
    ...commonTimestampColumns
})

export const tasks = pgTable('tasks', {
    id: serial('id'),
    title: varchar('title', { length: 255 }).notNull(),
    description: text('text'),
    status: integer('status').notNull().references(() => statuses.id),
    ...commonTimestampColumns
})
