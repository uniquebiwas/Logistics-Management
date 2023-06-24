<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent\AgentDocument;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentDocumentController extends Controller
{
    //
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function sendDocuments(Request $request)
    {
        $profile = $this->user->find($request->user()->id);
        $documents = AgentDocument::where('agentId', $profile->id)->get();


        $data = [
            'documents' => null,
            "title" => "Update Documents",
            "documents" => $documents
        ];

        if ($documents) {
            foreach ($documents as $document) {
                $document->file_path = asset("$document->documentPath");
                $data[$document->documentType] = $document;
            }
        }
        return view('agent.documents.update-documents', $data);
    }

    public   function agentDocuments(Request $request)
    {


        $profile = $this->user->find($request->user()->id);
        $documents = AgentDocument::where('agentId', $profile->id)->get();
        if ($documents) {
            foreach ($documents as $document) {
                $document->file_path = asset("$document->documentPath");
            }
        }
        $data = [
            'profile' => $profile,
            "title" => "My Documents",
            "documents" => $documents
        ];
        return view('agent.documents.ducument-list', $data);
    }
    protected function updatedocs($request, $user)
    {
        $data = [];
        if ($request->owner_citizenship) {
            $owner_citizenship =         uploadFile($request->owner_citizenship, "agents/$user->id/documents", false, "owner_citizenship", false);

            if ($owner_citizenship) {
                $owner_citizenship_document_data = [
                    'agentId' => $user->id,
                    "comments" => null,
                    'documentType' => "owner_citizenship",
                    'verifiedAt' => null,
                    'verifiedBy' => null,
                    // 'documentNo' => $request->owner_citizenship,
                    'documentPath' => $owner_citizenship,
                    'status' => 'unverified',
                ];

                $owner_citizenship_document = AgentDocument::where('agentId', $user->id)->where('documentType', 'owner_citizenship')->first();
                if ($owner_citizenship_document) {
                    $owner_citizenship_document->fill($owner_citizenship_document_data)->save();
                } else {
                    $owner_citizenship_document = AgentDocument::create($owner_citizenship_document_data);
                }
                // dd($owner_citizenship_document);
            }
        }
        if ($request->company_registration) {
            $company_registration =         uploadFile($request->company_registration, "agents/$user->id/documents", false, "company_registration", false);

            if ($company_registration) {
                $company_registration_document_data = [
                    'agentId' => $user->id,
                    "comments" => null,
                    'documentType' => "company_registration",
                    'verifiedAt' => null,
                    'verifiedBy' => null,
                    // 'documentNo' => $request->company_registration,
                    'documentPath' => $company_registration,
                    'status' => 'unverified',
                ];

                $company_registration_document = AgentDocument::where('agentId', $user->id)->where('documentType', 'company_registration')->first();
                if ($company_registration_document) {
                    $company_registration_document->fill($company_registration_document_data)->save();
                } else {
                    $company_registration_document = AgentDocument::create($company_registration_document_data);
                }
                // dd($company_registration_document);
            }
        }
        if ($request->pan_registration_document) {
            $pan_registration_document =         uploadFile($request->pan_registration_document, "agents/$user->id/documents", false, "pan_registration_document", false);

            if ($pan_registration_document) {
                $pan_registration_data = [
                    'agentId' => $user->id,
                    "comments" => null,
                    'documentType' => "pan_registration_document",
                    'verifiedAt' => null,
                    'verifiedBy' => null,
                    // 'documentNo' => $request->pan_registration_document,
                    'documentPath' => $pan_registration_document,
                    'status' => 'unverified',
                ];

                $pan_document = AgentDocument::where('agentId', $user->id)->where('documentType', 'pan_registration_document')->first();
                if ($pan_document) {
                    $pan_document->fill($pan_registration_data)->save();
                } else {
                    AgentDocument::create($pan_registration_data);
                }
            }
        }
        if ($request->tax_clarance) {
            $tax_clarance =         uploadFile($request->tax_clarance, "agents/$user->id/documents", false, "tax_clarance", false);

            if ($tax_clarance) {
                $tax_clarance_data = [
                    'agentId' => $user->id,
                    "comments" => null,
                    'documentType' => "tax_clarance",
                    'verifiedAt' => null,
                    'verifiedBy' => null,
                    // 'documentNo' => $request->tax_clarance,
                    'documentPath' => $tax_clarance,
                    'status' => 'unverified',
                ];

                $tax_clarance_document = AgentDocument::where('agentId', $user->id)->where('documentType', 'tax_clarance')->first();
                if ($tax_clarance_document) {
                    $tax_clarance_document->fill($tax_clarance_data)->save();
                } else {
                    AgentDocument::create($tax_clarance_data);
                }
            }
        }


        // dd($data);
    }

    public function submitDocuments(Request $request)
    {
        // dd($request->all());
        $user = $request->user();
        DB::beginTransaction();
        try {
            $this->updatedocs($request,  $user);
            DB::commit();
            $request->session()->flash('success', 'Your document updated successfully.');
            return redirect()->route('agentDocuments');
            //code...
        } catch (Exception $error) {
            dd($error);
            DB::rollback();
            $request->session('error', 'There is an error while updating your document, please try again later.');
            return redirect()->back();
        }
    }
}
