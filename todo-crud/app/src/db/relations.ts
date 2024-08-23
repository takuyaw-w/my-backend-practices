import { relations } from "drizzle-orm/relations";
import { statuses, tasks } from "./schema";

export const tasksRelations = relations(tasks, ({ one }) => ({
    status: one(statuses, {
        fields: [tasks.status_id],
        references: [statuses.id]
    }),
}));

export const statusesRelations = relations(statuses, ({ many }) => ({
    tasks: many(tasks),
}));
