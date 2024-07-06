import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head, Link, useForm} from '@inertiajs/react';
import { PageProps } from '@/types';
import { Button } from "@/Components/ui/button"
import {FormEventHandler, useEffect} from "react";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";

export default function Create({ auth }: PageProps) {
    const { data, setData, post, processing, errors, reset } = useForm({
        name: '',
        subject: '',
        mark: '',
    });

    useEffect(() => {
        return () => {
            reset('name', 'subject', 'mark');
        };
    }, []);

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route('student.store'));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Create Student</h2>}
        >
            <Head title="Create Student" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="text-center my-4">
                            <Button asChild>
                                <Link href={route('dashboard')}>Back</Link>
                            </Button>
                        </div>

                        <form onSubmit={submit} className="p-4">
                            <div>
                                <InputLabel htmlFor="name" value="Name"/>

                                <TextInput
                                    id="name"
                                    name="name"
                                    value={data.name}
                                    className="mt-1 block w-full"
                                    autoComplete="name"
                                    isFocused={true}
                                    onChange={(e) => setData('name', e.target.value)}
                                    required
                                />

                                <InputError message={errors.name} className="mt-2"/>
                            </div>

                            <div className="mt-4">
                                <InputLabel htmlFor="subject" value="Subject"/>

                                <TextInput
                                    id="subject"
                                    type="text"
                                    name="subject"
                                    value={data.subject}
                                    className="mt-1 block w-full"
                                    onChange={(e) => setData('subject', e.target.value)}
                                    required
                                />

                                <InputError message={errors.subject} className="mt-2"/>
                            </div>

                            <div className="mt-4">
                                <InputLabel htmlFor="mark" value="Mark"/>

                                <TextInput
                                    id="mark"
                                    type="number"
                                    name="mark"
                                    value={data.mark}
                                    className="mt-1 block w-full"
                                    onChange={(e) => setData('mark', e.target.value)}
                                    required
                                />

                                <InputError message={errors.mark} className="mt-2"/>
                            </div>

                            <div className="flex items-center justify-center mt-4">
                                <PrimaryButton className="ms-4" disabled={processing}>
                                    Create
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
