<?php

namespace Mineland405\FinancialSystemResource\Http\Traits;

trait NetworkTrait
{
    /**
     * Get members info in My Network (max out 5 level)
     */
    public function getNetworkMembers($userId)
    {
        $networkMembers = $this->mNetwork->where('member_id', $userId)->get();
        return $this->loopNetworkMember($networkMembers);
    }

    /**
     * Query Network
     */
    private function queryNetworkMember($userId)
    {
        return $this->mNetwork->where('member_id', $userId)->get();
    }

    /**
     * Loop for get Members info from level 1 to level 5
     */
    private function loopNetworkMember($members, $level = 1)
    {
        if(!empty($members)) {
            foreach($members as $key => $networkMember) {
                $members[$key] = $this->mUser->find($networkMember->relate_member_id);
                $members[$key]['members'] = $this->queryNetworkMember($networkMember->relate_member_id);
                
                $this->loopNetworkMember($members[$key]['members'], $level++);

                if($level > 5)
                    break;
            }
        }

        return $members;
    }

    /**
     * Get the my presenter ID and their parent IDs
     */
    public function getPresenterNetwork($userId, $presenters = [], $level = 1)
    {
        if($level > 5)
        return $presenters;
        
        $relationshipNetwork = $this->mNetwork->where('relate_member_id', $userId)->first();

        if($relationshipNetwork) {
            $presenters[] = $relationshipNetwork->member_id;
            return $this->getPresenterNetwork(end($presenters), $presenters, $level++);
        }

        return $presenters;
    }
}