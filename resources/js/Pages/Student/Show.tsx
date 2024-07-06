import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, Link} from '@inertiajs/react';
import { PageProps } from '@/types';
import { Button } from "@/Components/ui/button"

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table"

import {Student} from "@/Pages/Dashboard";

export default function Show({ auth, student }: PageProps<{student: Student}>) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Show {student?.name} </h2>}
        >
            <Head title={`Show ${student?.name}`} />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="text-center my-4">
                            <Button asChild>
                                <Link href={route('dashboard')}>Back</Link>
                            </Button>
                        </div>

                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead className="w-[100px]">S.NO</TableHead>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Subject</TableHead>
                                    <TableHead className="text-right">Mark</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                <TableRow key={student.id}>
                                    <TableCell className="font-medium">{student.id}</TableCell>
                                    <TableCell>{student.name}</TableCell>
                                    <TableCell>{student.subject}</TableCell>
                                    <TableCell className="text-right">{student.mark}</TableCell>
                                </TableRow>
                            </TableBody>
                        </Table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
