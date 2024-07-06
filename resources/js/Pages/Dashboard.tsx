import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, Link, router} from '@inertiajs/react';
import { PageProps } from '@/types';
import { Button } from "@/Components/ui/button"
import { useToast } from "@/Components/ui/use-toast"

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/Components/ui/table"

import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/Components/ui/dropdown-menu"


export interface Student {
    id: number
    name: string
    subject: string
    mark: number
    user?: {
        id: number
        name: string
        email: string
    }
}

export default function Dashboard({ auth, students }: PageProps<{students: Student[]}>) {
    const { toast } = useToast()

    const deleteStudent = (student: Student) => {
        if (!window.confirm("Are you sure you want to delete the user?")) {
            return;
        }
        router.delete(route('student.destroy', {student: student.id}));
        toast({
            description: "Student deleted successfully.",
        })
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="text-center my-4">
                            <Button asChild>
                                <Link href={route('student.create')}>Create</Link>
                            </Button>
                        </div>

                        <Table>
                            <TableHeader>
                                <TableRow>
                                    <TableHead className="w-[100px]">S.NO</TableHead>
                                    <TableHead>Name</TableHead>
                                    <TableHead>Subject</TableHead>
                                    <TableHead className="text-right">Mark</TableHead>
                                    <TableHead className="text-right">Action</TableHead>
                                </TableRow>
                            </TableHeader>
                            <TableBody>
                                {students.map((student) => (
                                    <TableRow key={student.id}>
                                        <TableCell className="font-medium">{student.id}</TableCell>
                                        <TableCell>{student.name}</TableCell>
                                        <TableCell>{student.subject}</TableCell>
                                        <TableCell className="text-right">{student.mark}</TableCell>
                                        <TableCell className="text-right">
                                            <DropdownMenu>
                                                <DropdownMenuTrigger>Action</DropdownMenuTrigger>
                                                <DropdownMenuContent>
                                                    <DropdownMenuLabel className="cursor-pointer">
                                                        <Link href={route('student.show', {student: student.id})}>Show</Link>
                                                    </DropdownMenuLabel>
                                                    <DropdownMenuSeparator />
                                                    <DropdownMenuLabel className="cursor-pointer">
                                                        <Link href={route('student.edit', {student: student.id})}>Edit</Link>
                                                    </DropdownMenuLabel>
                                                    <DropdownMenuSeparator />
                                                    <DropdownMenuItem className="cursor-pointer" onClick={e => deleteStudent(student)}>
                                                        Delete
                                                    </DropdownMenuItem>
                                                </DropdownMenuContent>
                                            </DropdownMenu>
                                        </TableCell>
                                    </TableRow>
                                ))}
                            </TableBody>
                        </Table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
