import { sql } from 'drizzle-orm'
import { pgTable, serial, timestamp, varchar, text, uniqueIndex, foreignKey, integer } from 'drizzle-orm/pg-core'

const commonTimestampColumns = {
    created_at: timestamp('created_at', { withTimezone: true, mode: 'string' }).defaultNow(),
    updated_at: timestamp('updated_at', { withTimezone: true, mode: 'string' }).defaultNow(),
    deleted_at: timestamp('deleted_at', { withTimezone: true, mode: 'string' }).default(sql`null`),
}

export const statuses = pgTable('statuses', {
    id: serial('id').primaryKey(),
    name: varchar('name', { length: 50 }).notNull(),
    ...commonTimestampColumns
}, (statuses) => ({
    uniqueNameIndex: uniqueIndex('unique_name_idx').on(statuses.name)
}))

export const tasks = pgTable('tasks', {
    id: serial('id').primaryKey(),
    title: varchar('title', { length: 255 }).notNull(),
    description: text('description'),
    status_id: integer('status_id').notNull().references(() => statuses.id),
    due_date: timestamp('due_date', { withTimezone: true, mode: 'string' }).notNull(),
    ...commonTimestampColumns
})
